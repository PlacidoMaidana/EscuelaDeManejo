<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\AlumnoEvento;

class CalendarioController extends Controller
{
    //

    public function index($idAlumnoCurso)
    {
        //dd($idAlumnoCurso);
        // código para mostrar la lista de elementos
        //$all_events = AlumnoEvento::all();

        $all_events = DB::table('alumno_evento')
        //->join('instructores as i','alumno_evento.id_instructor','=','i.id')
        //->join('vehiculos as v','alumno_evento.id_vehiculo','=','v.id')
        ->where('alumno_evento.id_alumno_curso','=', $idAlumnoCurso)
        ->select(['alumno_evento.id as id', 'id_vehiculo', 'id_instructor',
        'clase','start_date','end_date','asistencia','descripcion'])->get();

        $AlumnoCursoInfo = DB::table('alumnos_cursos')
        //->join('instructores as i','alumno_evento.id_instructor','=','i.id')
        //->join('vehiculos as v','alumno_evento.id_vehiculo','=','v.id')
        ->where('alumnos_cursos.id','=', $idAlumnoCurso)
        ->select(['alumnos_cursos.id as id', 'id_vehiculo', 'id_instructor'])->get();



       // dd($all_events,$AlumnoCursoInfo);
        


        $events = [];
       foreach ($all_events as $event) {
       
       $events[] = ['title' => $event->clase,
       'start' => $event->start_date,
       'end' => $event->end_date,
       'idAlumnoCurso'=>$idAlumnoCurso
    //    'idVehiculo'
    //    'idInstructor'
    //    'asistencia'
    //    'descripcion'
        ];
       }
           
        return view('calendario.calendario', compact('events','AlumnoCursoInfo'));
    }


    /**
     * POST BRE(A)D - Store data.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */

    public function store(Request $request)
    {
         //request()->validate(AlumnoEvento::$rules);
         //$clase=AlumnoEvento::create($request->all());
        
        
        $validator = \Validator::make($request->all(), [
                 'clase' => 'required|max:255',
                 'start_date' => 'required'
                 
        ]);
        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()],422);
        }

        $clase = AlumnoEvento::create([
          'clase' => $request['clase'],
          'start_date' => $request['start_date'],
          'end_date' => $request['end_date'] ,                   
        ]);
        

        return response()->json([
                       'clase'=>$clase,//$request['nombre_clase'],
                       'message' => 'Success'
          ], 200);
       
    }



}
