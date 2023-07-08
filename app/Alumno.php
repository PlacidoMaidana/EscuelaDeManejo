<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Alumno extends Model
{

    protected $table = 'alumnos';    
    protected $fillable=['nombre','direccion','mail','telefono','id_localidad'
    ];
}
