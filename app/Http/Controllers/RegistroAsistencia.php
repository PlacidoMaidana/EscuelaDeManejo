<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromCollection;

class RegistroAsistencia extends Controller
{
     public function index()
     {
        $franjasHorarias = DB::table('franjas_horarias')->get();
        return view('informes.asistencia_browse',compact('franjasHorarias'));
        
     }
     public function asistencia_clases_por_fecha($franjahoraria, $from)
 //    public function asistencia_clases_por_fecha()
     {
        
      return $datos = datatables()->of(DB::table('alumno_evento')
                ->join ('alumnos_cursos','alumnos_cursos.id','=','alumno_evento.id_alumno_curso')
                ->join('cursos','cursos.id','=','alumnos_cursos.id_curso')
                ->join('alumnos','alumnos.id','=','alumnos_cursos.id_alumno')
                ->leftjoin('tipos_eventos','tipos_eventos.id','=','alumno_evento.id_tipo_evento')
                ->leftjoin('instructores','instructores.id','=','alumno_evento.id_instructor')
                ->leftjoin('franjas_horarias','franjas_horarias.id','=','alumno_evento.id_franja_horaria')
                ->whereDate('alumno_evento.start_date','=',$from )
                ->where('alumno_evento.id_franja_horaria','=',$franjahoraria )
                ->select(['alumnos.nombre',
                          'cursos.nombre_curso',
                          'alumno_evento.start_date as fecha',
                          'alumno_evento.descripcion as clase',
                          'tipos_eventos.tipo_evento',
                          'instructores.nombre as nombre_instructor',
                          'alumno_evento.asistencia',
                          'franjas_horarias.descripcion',
                          ]))
                          ->addColumn('accion','vendor/voyager/alumno-evento/acciones_asistencia')
                          ->toJson();  
     }


}

