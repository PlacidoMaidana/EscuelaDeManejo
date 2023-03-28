<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class AlumnoEvento extends Model
{
    static $rules=[
        'clase'=>'required',
        'start_date'=>'required'
              
    ];
    protected $fillable = ['clase', 'start_date','end_date','id_alumno_curso','id_vehiculo', 'id_instructor','asistencia', 'descripcion'];
    protected $table = 'alumno_evento';    
}
