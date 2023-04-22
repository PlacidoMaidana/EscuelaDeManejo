<?php

namespace App\Http\Livewire;

use App\Alumno;
use TCG\Voyager\Facades\Voyager;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


use Livewire\Component;

class FichaAlumno extends Component
{

       // public $id;
        public $nombre;
        public $direccion;
        public $mail;
        public $telefono;
        public $foto;
        public $alumno_curso_id=2;
       
    public function render()
    {
        $slug='alumnos';
        $dataType = DB::table('data_types')->where('slug', '=', $slug)->first();
        $dataTypeContent = DB::table('data_rows')
        ->select('field', 'type', 'display_name', 'required')
        ->where('data_type_id','=',10)->get();
        
        return view('livewire.ficha-alumno',compact('dataType',
           'dataTypeContent'));
    }

    public function guardar()
    {
        $alumno=new Alumno;
        $alumno->nombre=  $this->nombre;
        $alumno->direccion=$this->direccion;
        $alumno->mail= $this->mail;
        $alumno->telefono= $this->telefono;
                          //$this->foto;
                          
       
        $alumno->save();
        return redirect('admin/alumnos-cursos/'.$this->alumno_curso_id.'/edit');
    }

}
