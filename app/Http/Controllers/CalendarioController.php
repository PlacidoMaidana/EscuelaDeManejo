<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\AlumnoEvento;
use Carbon\Carbon;

class CalendarioController extends Controller
{
    //

    public function index($idAlumnoCurso)
    {
       
        $all_events = DB::table('alumno_evento')
        ->join('instructores','alumno_evento.id_instructor','=','instructores.id')
        ->join('vehiculos','alumno_evento.id_vehiculo','=','vehiculos.id')
        ->where('alumno_evento.id_alumno_curso','=', $idAlumnoCurso)
        ->select(['alumno_evento.id as id', 'id_vehiculo', 'vehiculos.marca_modelo_anio as marca_modelo_anio',
          'id_instructor','instructores.nombre as nombre',
          'clase','start_date','end_date','asistencia','descripcion'])->get();

        $AlumnoCursoInfo = DB::table('alumnos_cursos')
        //->join('instructores as i','alumno_evento.id_instructor','=','i.id')
        //->join('vehiculos as v','alumno_evento.id_vehiculo','=','v.id')
        ->where('alumnos_cursos.id','=', $idAlumnoCurso)
        ->select(['alumnos_cursos.id as id'])->get();
       


        $events = [];
       foreach ($all_events as $event) {
       
       $events[] = ['id' => $event->id,
       'title' => $event->clase,
       'start' => $event->start_date,
       'end' => $event->end_date,
       'idAlumnoCurso'=>$idAlumnoCurso,
       'idVehiculo'=>$event->id_vehiculo,
       'marca_modelo_anio'=>$event->marca_modelo_anio,
       'idInstructor'=>$event->id_instructor,
       'nombre'=>$event->nombre,
       'asistencia'=>$event->asistencia,
       'descripcion'=>$event->descripcion
 
        ];
       }
           
        return view('calendario.calendario', compact('events','AlumnoCursoInfo','idAlumnoCurso'));
    }


    /**
     * POST BRE(A)D - Store data.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @return \Illuminate\Http\Response
     */
    public function show(AlumnoEvento $evento)
    {
        $evento=AlumnoEvento::all();
        return response()->json($evento); 

    }
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
          'id_alumno_curso' => $request['idAlumnoCurso'] ,
          'id_vehiculo' => $request['idVehiculo'] ,
          'id_instructor' => $request['idInstructor'] ,
          'asistencia' => $request['asistencia'] ,
          'descripcion' => $request['descripcion'] ,

        ]);
        

        return response()->json([
                       'clase'=>$clase,//$request['nombre_clase'],
                       'message' => 'Success'
          ], 200);
       
    }


    public function edit($id)
    {
       $evento=AlumnoEvento::find($id);
       $evento->start_date = Carbon::createFromFormat('Y-m-d H:i:s', $evento->start_date)->Format('Y-m-d H:i') ;
       $evento->end_date = Carbon::createFromFormat('Y-m-d H:i:s', $evento->end_date)->Format('Y-m-d H:i') ;
       return response()->json($evento);   
    }

    public function destroy($id)
    {
      
        $evento=AlumnoEvento::find($id)->delete();
        return response()->json($evento);
    }


    public function update(Request $request, AlumnoEvento $evento)
    {
        request()->validate(AlumnoEvento::$rules);
        $evento->update($request->all());
        return response()->json($evento);
    }




}
