<?php

namespace App\Exports;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class Planilla_alumnosExport implements FromCollection
{
    public $fecha;
    public $instructor;
 
   
    public function collection()
    {
 
        return DB::table('alumno_evento')
        ->join ('alumnos_cursos','alumnos_cursos.id','=','alumno_evento.id_alumno_curso')
        ->join('cursos','cursos.id','=','alumnos_cursos.id_curso')
        ->join('alumnos','alumnos.id','=','alumnos_cursos.id_alumno')
        ->whereDate('alumno_evento.start_date','=',$this->fecha)
        ->where('alumno_evento.id_instructor','=',$this->instructor)
        ->select(['alumno_evento.start_date',
                  'alumnos.nombre',
                  'alumnos.telefono',
                  'cursos.nombre_curso',
                  'alumno_evento.clase',
                  'alumno_evento.descripcion'   ])
                    ->get()  ;
             
  
    }
}