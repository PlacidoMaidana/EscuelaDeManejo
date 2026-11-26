<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * SRS – Recargo por medio de pago en el cobro y el recibo.
 * ingresos_cursos.importe sigue siendo el "Importe del curso" (cancela saldo).
 * ingresos_cursos.recargo es el "Recargo por financiación"; Total abonado = importe + recargo.
 */
class AddRecargoToIngresosCursos extends Migration
{
    public function up()
    {
        Schema::table('ingresos_cursos', function (Blueprint $table) {
            $table->decimal('recargo', 10, 0)->default(0)->after('importe');
        });

        $dt = DB::table('data_types')->where('slug', 'ingresos-cursos')->value('id');
        if ($dt) {
            DB::table('data_rows')->where('data_type_id', $dt)->where('field', 'importe')
                ->update(['display_name' => 'Importe del curso']);

            // el campo nuevo va justo después de Importe del curso
            DB::table('data_rows')->where('data_type_id', $dt)->where('order', '>', 3)->increment('order');
            DB::table('data_rows')->insert([
                'data_type_id' => $dt,
                'field' => 'recargo',
                'type' => 'number',
                'display_name' => 'Recargo por financiación',
                'required' => 0,
                'browse' => 1, 'read' => 1, 'edit' => 1, 'add' => 1, 'delete' => 0,
                'details' => json_encode([
                    'default' => '0',
                    'min' => 0,
                    'step' => 1,
                    'validation' => [
                        'rule' => 'nullable|integer|min:0',
                        'messages' => [
                            'integer' => 'El recargo debe ser un número entero.',
                            'min' => 'El recargo no puede ser negativo.',
                        ],
                    ],
                ], JSON_UNESCAPED_UNICODE),
                'order' => 4,
            ]);
        }
    }

    public function down()
    {
        $dt = DB::table('data_types')->where('slug', 'ingresos-cursos')->value('id');
        if ($dt) {
            DB::table('data_rows')->where('data_type_id', $dt)->where('field', 'recargo')->delete();
            DB::table('data_rows')->where('data_type_id', $dt)->where('order', '>', 4)->decrement('order');
            DB::table('data_rows')->where('data_type_id', $dt)->where('field', 'importe')
                ->update(['display_name' => 'Importe']);
        }
        Schema::table('ingresos_cursos', function (Blueprint $table) {
            $table->dropColumn('recargo');
        });
    }
}
