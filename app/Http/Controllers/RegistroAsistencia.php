<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\Session;

class RegistroAsistencia extends Controller
{
    /*
     public function index()
     {
        $franjasHorarias = DB::table('franjas_horarias')->get();
        return view('informes.asistencia_browse',compact(['franjasHorarias']));
        
     }
     */
     public function index()
     {

      if (Session::has('fecha') && Session::has('hora') ) {
         // La variable de sesión 'miVariable' está configurada

         $fecha=Session::get('fecha');
         $horario= Session::get('hora');

       }else {
         $fecha=today();
         $horario= 1;
       }
      
        
        

        $franjasHorarias = DB::table('franjas_horarias')->get();
        return view('informes.asistencia_browse',compact(['franjasHorarias','fecha','horario']));
        
     }

     public function guardarUrl(Request $request)
       {
           $url = $request->input('url');
           $fecha = $request->input('fecha');
           $hora = $request->input('hora');
           session(['url' => $url]); // Almacena la URL en la sesión
           session(['fecha' => $fecha]); // Almacena la URL en la sesión
           session(['hora' => $hora]); // Almacena la URL en la sesión

           return response()->json(['url'=>$request->input('url'),'success' => true]); // Puedes devolver una respuesta JSON si es necesario
       }
     
     public function asistencia_clases_por_fecha($franjahoraria, $from)
 //    public function asistencia_clases_por_fecha()
     {
        $sucursal = auth()->user()->id_sucursal;
      
      return $datos = datatables()->of(DB::table('alumno_evento')
                ->join ('alumnos_cursos','alumnos_cursos.id','=','alumno_evento.id_alumno_curso')
                ->join('cursos','cursos.id','=','alumnos_cursos.id_curso')
                ->join('alumnos','alumnos.id','=','alumnos_cursos.id_alumno')
                ->leftjoin('tipos_eventos','tipos_eventos.id','=','alumno_evento.id_tipo_evento')
                ->leftjoin('instructores','instructores.id','=','alumno_evento.id_instructor')
                ->leftjoin('franjas_horarias','franjas_horarias.id','=','alumno_evento.id_franja_horaria')
                ->whereDate('alumno_evento.start_date','=',$from )
                ->where('alumno_evento.id_franja_horaria','=',$franjahoraria )
                ->where('alumnos_cursos.id_sucursal','=',$sucursal )
                ->select(['alumno_evento.id',
                          'alumnos.nombre',
                          'cursos.nombre_curso',
                          'alumno_evento.start_date as fecha',
                          'alumno_evento.descripcion as observaciones',
                          'alumno_evento.clase as clase',
                          'tipos_eventos.tipo_evento',
                          'instructores.nombre as nombre_instructor',
                          'alumno_evento.asistencia',
                          'franjas_horarias.descripcion'
                          ]))
                          ->setRowAttr([
                           'style' => 'background-color: #EFEE06;',      
                            ]) 
                     ->setRowAttr([
                           'style' => function($item){          
                             switch ($item->asistencia) {
                               
                               case 'SI':
                                 return 'background-color: #EFBB07;color:#000000';
                                 break; 
                                                           
                               default:
                                 # code...
                                 break;
                             }
                           }
                       ])   
                          ->addColumn('check','vendor/voyager/alumno-evento/check')
                          ->addColumn('accion','vendor/voyager/alumno-evento/acciones_asistencia')
                          ->rawColumns(['check','accion'])  
                          ->toJson();  
     }

     public function  actualiza_asistencia($clases_marcadas)
      {
         if ($clases_marcadas != "") {
             $lista_id = explode(",",$clases_marcadas);
             foreach($lista_id as $clase) {

                  DB::table('alumno_evento')
                  ->where('id',$clase)
                  ->update(['asistencia' => 'SI']);
               }
            }
         return redirect('/RegistroAsistencia/');
        // return redirect('/asistencia_clases/{franjahoraria}/{from});

      }
   

}

