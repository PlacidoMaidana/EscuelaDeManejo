<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class AlumnoEvento extends Model
{
    static $rules=[
        'clase'=>'required',
        'start_date'=>'required'
              
    ];
    protected $fillable = ['clase', 'start_date','end_date',];
    protected $table = 'alumno_evento';    
}
