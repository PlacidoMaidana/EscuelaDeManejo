<?php

namespace App\Exports;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class Informe_ventasExportComisiones implements FromCollection
{
    public $desde;
    public $hasta;
    
    
    public function collection()
    {
        return DB::table('alumnos_cursos')
        ->join('cursos','cursos.id','=','alumnos_cursos.id_curso')
        ->join('alumnos','alumnos.id','=','alumnos_cursos.id_alumno')
        ->leftjoin('empleados','empleados.id','=','alumnos_cursos.id_vendedor')
        ->whereBetween('alumnos_cursos.fecha_inscripcion',array($this->desde,$this->hasta)  )
        ->select(['alumnos_cursos.fecha_inscripcion',
        'alumnos.nombre',
        'cursos.nombre_curso',
        'empleados.nombre as vendedor',
        'alumnos_cursos.precio',
        'cursos.monto_comision'  ])
        ->get()  ;


        
    }
}