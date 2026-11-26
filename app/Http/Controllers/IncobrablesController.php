<?php

namespace App\Http\Controllers;

use App\Services\Incobrables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RuntimeException;

/**
 * Pantalla "Incobrables" (solo rol Sistemas, ver middleware solo.sistemas).
 */
class IncobrablesController extends Controller
{
    public function index(Request $request)
    {
        $sucursales = DB::table('sucursales')->orderBy('sucursal')->get();
        $idSucursal = $request->query('sucursal');
        $meses = $request->query('meses', Incobrables::MESES_POR_DEFECTO);
        $cuentas = null;
        $huella = null;

        if ($request->has('vista_previa')) {
            $request->validate([
                'sucursal' => 'required|integer|exists:sucursales,id',
                'meses' => 'required|integer|min:1',
            ], [], ['sucursal' => 'sucursal', 'meses' => 'meses']);
            $cuentas = Incobrables::vistaPrevia((int) $idSucursal, (int) $meses);
            $huella = Incobrables::huella($cuentas);
        }

        $lotes = DB::table('incobrables_lotes as l')
            ->join('sucursales as s', 's.id', '=', 'l.id_sucursal')
            ->leftJoin('users as u', 'u.id', '=', 'l.id_usuario')
            ->leftJoin('users as r', 'r.id', '=', 'l.revertido_por')
            ->orderByDesc('l.id')
            ->select([
                'l.*', 's.sucursal', 'u.name as usuario', 'r.name as revertido_por_nombre',
                DB::raw("(SELECT COUNT(*) FROM incobrables_lotes_cuentas c WHERE c.id_lote = l.id AND c.estado = 'Activa') as activas"),
            ])
            ->get();

        return view('incobrables.index', [
            'sucursales' => $sucursales,
            'idSucursal' => $idSucursal,
            'meses' => $meses,
            'fechaCorte' => is_numeric($meses) && $meses >= 1 ? Incobrables::fechaCorte((int) $meses) : null,
            'cuentas' => $cuentas,
            'huella' => $huella,
            'lotes' => $lotes,
        ]);
    }

    public function confirmar(Request $request)
    {
        $request->validate([
            'sucursal' => 'required|integer|exists:sucursales,id',
            'meses' => 'required|integer|min:1',
            'huella' => 'required|string',
        ]);
        $idSucursal = (int) $request->input('sucursal');
        $meses = (int) $request->input('meses');

        $idLote = Incobrables::confirmar($idSucursal, $meses, $request->input('huella'), $request->user()->id);

        if ($idLote === null) {
            return redirect()
                ->route('incobrables.index', ['sucursal' => $idSucursal, 'meses' => $meses, 'vista_previa' => 1])
                ->with(['message' => 'Las cuentas cambiaron desde la vista previa. No se grabó nada: revisá la vista previa actualizada.', 'alert-type' => 'warning']);
        }

        return redirect()->route('incobrables.lote', $idLote)
            ->with(['message' => "Lote $idLote creado.", 'alert-type' => 'success']);
    }

    public function lote($id)
    {
        $lote = DB::table('incobrables_lotes as l')
            ->join('sucursales as s', 's.id', '=', 'l.id_sucursal')
            ->leftJoin('users as u', 'u.id', '=', 'l.id_usuario')
            ->leftJoin('users as r', 'r.id', '=', 'l.revertido_por')
            ->where('l.id', $id)
            ->select(['l.*', 's.sucursal', 'u.name as usuario', 'r.name as revertido_por_nombre'])
            ->first();
        abort_if(!$lote, 404);

        $cuentas = DB::table('incobrables_lotes_cuentas as c')
            ->join('alumnos_cursos as a', 'a.id', '=', 'c.id_alumno_curso')
            ->leftJoin('alumnos as al', 'al.id', '=', 'a.id_alumno')
            ->leftJoin('cursos as cu', 'cu.id', '=', 'a.id_curso')
            ->leftJoin('users as u', 'u.id', '=', 'c.reactivado_por')
            ->where('c.id_lote', $id)
            ->orderBy('c.id')
            ->select(['c.*', 'al.nombre as alumno', 'cu.nombre_curso as curso', 'a.fecha_inscripcion', 'u.name as reactivado_por_nombre'])
            ->get();

        return view('incobrables.lote', compact('lote', 'cuentas'));
    }

    public function reactivar(Request $request, $id, $cuenta)
    {
        try {
            Incobrables::reactivarCuenta((int) $id, (int) $cuenta, $request->user()->id);
        } catch (RuntimeException $e) {
            return redirect()->route('incobrables.lote', $id)
                ->with(['message' => $e->getMessage(), 'alert-type' => 'error']);
        }

        return redirect()->route('incobrables.lote', $id)
            ->with(['message' => 'Cuenta reactivada: ya se le puede cobrar.', 'alert-type' => 'success']);
    }

    public function revertir(Request $request, $id)
    {
        try {
            Incobrables::revertirLote((int) $id, $request->user()->id);
        } catch (RuntimeException $e) {
            return redirect()->route('incobrables.lote', $id)
                ->with(['message' => $e->getMessage(), 'alert-type' => 'error']);
        }

        return redirect()->route('incobrables.lote', $id)
            ->with(['message' => "Lote $id revertido.", 'alert-type' => 'success']);
    }
}
