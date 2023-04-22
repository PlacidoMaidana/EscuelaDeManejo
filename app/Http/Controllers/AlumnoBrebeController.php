<?php

namespace App\Http\Controllers;

use TCG\Voyager\Facades\Voyager;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class AlumnoBrebeController extends \TCG\Voyager\Http\Controllers\VoyagerBaseController //extends Controller
{
    //
    public function nuevo(Request $request)    
    {
        
        $slug='alumnos';
        $dataType = DB::table('data_types')->where('slug', '=', $slug)->first();
       
        // Check permission
        $this->authorize('add', app($dataType->model_name));

        
        $dataTypeContent = DB::table('data_rows')
        ->select('field', 'type', 'display_name', 'required')
        ->where('data_type_id','=',10)->get();
     

        dd($dataTypeContent);
        


        return view('vendor.voyager.clientes.fichaCliente_NotaPedido', compact( 'dataType',
                     'dataTypeContent'  ));
    }

    public function alumno_elegir()
    {
        return datatables()->of(DB::table('alumnos')
        ->select([  'alumnos.id',
                'alumnos.nombre',
                'alumnos.direccion',
                'alumnos.mail',
                'alumnos.telefono'                
              ]))
    ->addColumn('seleccionar',"vendor/voyager/alumnos-cursos/boton_seleccionarAlumno")
    ->rawColumns(['seleccionar'])     
    ->toJson();   
           
    }


}
