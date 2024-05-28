<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Exports\Informe_ventasExportComisiones;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromCollection;

class informes_ventas_comisiones extends Controller
{
     public function index()
     {
       
        return view('informes.informes_ventas_comisiones');
        
     }

     public function en_rango_de_fechas($from,$to)
     {
        return $datos = datatables()->of(DB::table('alumnos_cursos')
            ->join('cursos','cursos.id','=','alumnos_cursos.id_curso')
            ->join('alumnos','alumnos.id','=','alumnos_cursos.id_alumno')
            ->leftjoin('empleados','empleados.id','=','alumnos_cursos.id_vendedor')
            ->leftjoin('sucursales','sucursales.id','=','alumnos_cursos.id_sucursal')
            ->whereBetween('alumnos_cursos.fecha_inscripcion',array($from,$to) )
            ->select(['alumnos_cursos.fecha_inscripcion',
            'alumnos.nombre',
            'cursos.nombre_curso',
            'empleados.nombre as vendedor',
            'sucursales.sucursal as sucursal',
            'alumnos_cursos.precio',
            'cursos.monto_comision'  ]))
   ->toJson();  
     }


   public function totalesen_rango_de_fechas($from,$to)      
    { 
            return $totales = datatables()->of(DB::table('alumnos_cursos')
            ->join('cursos as c','c.id','=','alumnos_cursos.id_curso')
            ->join('sucursales as s','s.id','=','alumnos_cursos.id_sucursal')
            ->leftjoin('empleados as v','v.id','=','alumnos_cursos.id_vendedor')
            ->whereBetween('alumnos_cursos.fecha_inscripcion',array($from,$to) )
            ->groupBy('s.sucursal', 'v.nombre')
            ->select(['s.sucursal',
                      'v.nombre',
                       DB::raw('SUM(alumnos_cursos.precio) AS Importe_Venta'),
                       DB::raw('SUM(c.monto_comision) AS Comisiones'),
                        ]))
             ->toJson();  
            
 

    }
    public function export($desde,$hasta) 
    {
      $aa = new Informe_ventasExportComisiones("fecha	alumno	tipo curso	vendedor	sucursal	importe");
      $aa->desde=$desde;
      $aa->hasta=$hasta;
      return Excel::download($aa, 'informe_ventas_comisiones.xlsx');
     // dd($aa)  ;

    } 
    
}

