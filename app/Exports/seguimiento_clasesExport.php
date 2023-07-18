<?php

namespace App\Exports;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class seguimiento_clasesExport implements FromCollection
{
    public $id_alumno_curso;
    
    public function collection()
    {

     
      return DB::table('alumno_evento') 
        ->join('alumnos_cursos','alumno_evento.id_alumno_curso','=','alumnos_cursos.id')
        ->join('alumnos','alumnos_cursos.id_alumno','=','alumnos.id')
        ->join('cursos','alumnos_cursos.id_curso','=','cursos.id')
        ->leftjoin('instructores','alumno_evento.id_instructor','=','instructores.id')
        ->leftjoin('tipos_eventos','alumno_evento.id_tipo_evento','=','tipos_eventos.id')
        ->leftjoin('franjas_horarias','alumno_evento.id_franja_horaria','=','franjas_horarias.id')
       // ->where('alumnos_cursos.activo','=','SI')
        ->where('alumnos_cursos.id','=', $this->id_alumno_curso)
        ->select([ 'alumno_evento.id',
                   'alumnos_cursos.id as id_Alumno_Curso',
                   'alumnos.nombre as nombre_alumno',
                   'cursos.nombre_curso',
                   'alumno_evento.start_date as fecha',
                   'franjas_horarias.descripcion',
                   'tipos_eventos.tipo_evento',
                   'instructores.nombre as nombre_instructor',
                   'alumno_evento.asistencia',
                   'alumno_evento.descripcion as clase',
                   
                 ])
        ->get()  ;
             
      }
}