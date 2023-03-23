<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ActividadesAlumno;

class eventos_curso extends Controller
{
    public function index()
    {
        return view('evento.index');
    }

    public function store(Request $request)
    {
        
        request()->validate(ActividadesAlumno::$rules);
        $actividad_alumno=ActividadesAlumno::create($request->all());
    }

}
