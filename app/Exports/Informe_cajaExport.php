<?php

namespace App\Exports;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class Informe_cajaExport implements FromCollection
{
    public $fecha;
    public $operador;
 
   
    public function collection()
    {

        $ingresos = DB::table('ingresos_cursos')
        ->join ('alumnos_cursos','ingresos_cursos.id_alumno_curso','=','alumnos_cursos.id')
        ->join('sucursales','sucursales.id','=','alumnos_cursos.id_sucursal')
        ->join('users','users.id','=','ingresos_cursos.id_usuario')
        ->join('alumnos','alumnos.id','=','alumnos_cursos.id_alumno')
        ->join('cursos','cursos.id','=','alumnos_cursos.id_curso')
        ->where('ingresos_cursos.fecha','=',$this->fecha)
        ->where('ingresos_cursos.id_usuario','=',$this->operador )
        ->select(['"INGRESOS" as tipo',
                   'ingresos_cursos.fecha',
                   'users.name as operador',
                   'ingresos_cursos.modalidad_pago',
                   'ingresos_cursos.importe',
                   'alumnos.nombre as detalle1',
                   'cursos.nombre_curso as detalle2',
                   '"-" as detalle3'   ]);
        //dd($ingresos);
       $egresosingresos= DB::table('egresos_gastos')
       ->leftjoin ('tipos_gastos','egresos_gastos.id_tipo_gasto','=','tipos_gastos.id')
       ->join('sucursales','sucursales.id','=','egresos_gastos.id_sucursal')
       ->where('egresos_gastos.fecha','=',$this->fecha)
       ->where('egresos_gastos.id_empleado','=',$this->operador)
       ->select(['"EGRESOS" as tipo',
                  'egresos_gastos.fecha',
                  'users.name as operador',
                  'egresos_gastos.modalidad_pago',
                 'egresos_gastos.importe',
                 'egresos_gastos.descripcion as detalle1',
                 'tipos_gastos.tipo1 as detalle2 ',
                 'tipos_gastos.tipo2 as detalle3'])
                 ->union($ingresos)
                 ->get()  ;

    }
}