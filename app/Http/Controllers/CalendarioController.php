<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AlumnoEvento;

class CalendarioController extends Controller
{
    //

    public function index()
    {
        // código para mostrar la lista de elementos
        $all_events = AlumnoEvento::all();
        $events = [];
       foreach ($all_events as $event) {
       
       $events[] = ['title' => $event->clase,
       'start' => $event->start_date,
       'end' => $event->end_date,];
       }
           
        return view('calendario.calendario', compact('events'));
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
