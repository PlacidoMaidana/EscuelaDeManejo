<?php

namespace App\Services;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use RuntimeException;

/**
 * Baja de saldos viejos como "Incobrable" por lotes reversibles.
 * Ver SRS – Registro de Incobrables en Informe de Cobranzas.
 */
class Incobrables
{
    public const MODALIDAD = 'Incobrable';
    public const TIPO_PAGO = 'incobrable';
    public const MESES_POR_DEFECTO = 12;

    /**
     * Fecha de hoy según MySQL (hora local del negocio). La app corre en UTC y,
     * de noche, Carbon::today() ya sería el día siguiente.
     */
    public static function hoy(): string
    {
        return DB::selectOne('SELECT CURDATE() AS d')->d;
    }

    /** Fecha de corte: se dan de baja cuentas inscriptas hasta esa fecha inclusive. */
    public static function fechaCorte(int $meses): string
    {
        return Carbon::parse(self::hoy())->subMonths($meses)->toDateString();
    }

    /**
     * Cuentas de la sucursal inscriptas antes del corte con saldo > 0 (RF-04).
     * Mismo criterio que el "Saldo pendiente de Cobro": solo cuentas con al menos un pago.
     */
    public static function vistaPrevia(int $idSucursal, int $meses, bool $bloquear = false)
    {
        $q = DB::table('alumnos_cursos as a')
            ->join('ingresos_cursos as i', 'i.id_alumno_curso', '=', 'a.id')
            ->leftJoin('alumnos as al', 'al.id', '=', 'a.id_alumno')
            ->leftJoin('cursos as c', 'c.id', '=', 'a.id_curso')
            ->where('a.id_sucursal', $idSucursal)
            ->where('a.fecha_inscripcion', '<=', self::fechaCorte($meses))
            ->groupBy('a.id', 'al.nombre', 'c.nombre_curso', 'a.fecha_inscripcion', 'a.precio')
            ->havingRaw('a.precio - SUM(i.importe) > 0')
            ->orderBy('a.fecha_inscripcion')
            ->orderBy('a.id')
            ->select([
                'a.id', 'al.nombre as alumno', 'c.nombre_curso as curso', 'a.fecha_inscripcion', 'a.precio',
                DB::raw('SUM(i.importe) as pagado'),
                DB::raw('a.precio - SUM(i.importe) as saldo'),
            ]);
        if ($bloquear) {
            $q->lockForUpdate();
        }

        return $q->get();
    }

    /** Huella de la vista previa: si cambia entre la vista previa y la confirmación, no se graba (RN-04). */
    public static function huella($cuentas): string
    {
        return sha1($cuentas->map(fn ($c) => $c->id . ':' . $c->saldo)->implode('|'));
    }

    /**
     * Graba el lote y un pago Incobrable por cuenta, todo o nada (RF-05, RN-03).
     * Devuelve el id del lote, o null si la vista previa cambió.
     */
    public static function confirmar(int $idSucursal, int $meses, string $huella, int $idUsuario): ?int
    {
        return DB::transaction(function () use ($idSucursal, $meses, $huella, $idUsuario) {
            $cuentas = self::vistaPrevia($idSucursal, $meses, true);
            if ($cuentas->isEmpty() || self::huella($cuentas) !== $huella) {
                return null;
            }

            $ahora = now();
            $idLote = DB::table('incobrables_lotes')->insertGetId([
                'id_sucursal' => $idSucursal,
                'meses' => $meses,
                'fecha_corte' => self::fechaCorte($meses),
                'id_usuario' => $idUsuario,
                'cantidad' => $cuentas->count(),
                'monto' => $cuentas->sum('saldo'),
                'estado' => 'Activo',
                'created_at' => $ahora,
                'updated_at' => $ahora,
            ]);

            foreach ($cuentas as $c) {
                $idIngreso = DB::table('ingresos_cursos')->insertGetId([
                    'fecha' => self::hoy(),
                    'importe' => $c->saldo,
                    'recargo' => 0, // los Incobrable nunca llevan recargo (SRS Recargo, RN-03)
                    'id_alumno_curso' => $c->id,
                    'modalidad_pago' => self::MODALIDAD,
                    'tipo_pago' => self::TIPO_PAGO,
                    'detalle' => 'Incobrable – lote ' . $idLote,
                    'id_usuario' => $idUsuario,
                    'id_lote_incobrable' => $idLote,
                    'created_at' => $ahora,
                    'updated_at' => $ahora,
                ]);
                DB::table('incobrables_lotes_cuentas')->insert([
                    'id_lote' => $idLote,
                    'id_alumno_curso' => $c->id,
                    'id_ingreso' => $idIngreso,
                    'saldo_dado_de_baja' => $c->saldo,
                    'estado' => 'Activa',
                    'created_at' => $ahora,
                    'updated_at' => $ahora,
                ]);
            }

            return $idLote;
        });
    }

    /** Reactiva una sola cuenta del lote: borra su pago Incobrable (RF-15, RN-07). */
    public static function reactivarCuenta(int $idLote, int $idCuentaLote, int $idUsuario): void
    {
        DB::transaction(function () use ($idLote, $idCuentaLote, $idUsuario) {
            $lote = DB::table('incobrables_lotes')->where('id', $idLote)->lockForUpdate()->first();
            $cuenta = DB::table('incobrables_lotes_cuentas')
                ->where('id', $idCuentaLote)->where('id_lote', $idLote)->lockForUpdate()->first();
            if (!$lote || $lote->estado !== 'Activo' || !$cuenta || $cuenta->estado !== 'Activa') {
                throw new RuntimeException('La cuenta no está activa en un lote activo.');
            }
            DB::table('ingresos_cursos')
                ->where('id', $cuenta->id_ingreso)->where('id_lote_incobrable', $idLote)->delete();
            DB::table('incobrables_lotes_cuentas')->where('id', $cuenta->id)->update([
                'estado' => 'Reactivada', 'reactivado_por' => $idUsuario,
                'reactivado_at' => now(), 'updated_at' => now(),
            ]);
        });
    }

    /** Revierte el lote: borra los pagos de las cuentas que siguen activas (RF-08). */
    public static function revertirLote(int $idLote, int $idUsuario): void
    {
        DB::transaction(function () use ($idLote, $idUsuario) {
            $lote = DB::table('incobrables_lotes')->where('id', $idLote)->lockForUpdate()->first();
            if (!$lote || $lote->estado !== 'Activo') {
                throw new RuntimeException('El lote no está activo.');
            }
            $activas = DB::table('incobrables_lotes_cuentas')
                ->where('id_lote', $idLote)->where('estado', 'Activa')->pluck('id_ingreso');
            DB::table('ingresos_cursos')
                ->whereIn('id', $activas)->where('id_lote_incobrable', $idLote)->delete();
            DB::table('incobrables_lotes_cuentas')
                ->where('id_lote', $idLote)->where('estado', 'Activa')
                ->update(['estado' => 'Revertida', 'updated_at' => now()]);
            DB::table('incobrables_lotes')->where('id', $idLote)->update([
                'estado' => 'Revertido', 'revertido_por' => $idUsuario,
                'revertido_at' => now(), 'updated_at' => now(),
            ]);
        });
    }

    /** true si la cuenta tiene un pago Incobrable vigente: no se le puede cobrar (RF-16). */
    public static function cuentaDadaDeBaja($idAlumnoCurso): bool
    {
        return $idAlumnoCurso !== null && $idAlumnoCurso !== '' && DB::table('ingresos_cursos')
            ->where('id_alumno_curso', $idAlumnoCurso)
            ->whereNotNull('id_lote_incobrable')
            ->exists();
    }

    public const AVISO_BLOQUEO = 'Cuenta dada de baja como incobrable. Pedir a Sistemas que la reactive.';
}
