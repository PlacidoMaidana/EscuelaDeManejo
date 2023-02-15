<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class eventos_curso extends Controller
{
    public function index()
    {
        return view('evento.index');
    }
}
