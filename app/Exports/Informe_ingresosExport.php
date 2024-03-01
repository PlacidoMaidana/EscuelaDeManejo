<?php

namespace App\Exports;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class Informe_ingresosExport implements FromCollection
{
    public $desde;
    public $hasta;
 
    
    public function collection()
    {
        $sucursal = auth()->user()->id_sucursal;
        
       return DB::table('ingresos_cursos')
       ->join ('alumnos_cursos','ingresos_cursos.id_alumno_curso','=','alumnos_cursos.id')
       ->join('sucursales','sucursales.id','=','alumnos_cursos.id_sucursal')
       ->join('alumnos','alumnos.id','=','alumnos_cursos.id_alumno')
       ->join('cursos','cursos.id','=','alumnos_cursos.id_curso')
       ->leftjoin('users','users.id','=','ingresos_cursos.id_usuario')
       ->leftjoin('empleados','empleados.id','=','alumnos_cursos.id_vendedor')
       ->whereBetween('ingresos_cursos.fecha',array($this->desde,$this->hasta) )
       ->where('users.id_sucursal','=',$sucursal)
       ->select(['ingresos_cursos.fecha',
                 'sucursales.sucursal',
                 'alumnos.nombre as nombre_alumno',
                 'cursos.nombre_curso',
                 'users.name',
                 'ingresos_cursos.modalidad_pago',
                 'ingresos_cursos.importe',
                 'ingresos_cursos.detalle',
                 'empleados.nombre'                
                   ])       
           ->get()  ;
  
    }
}