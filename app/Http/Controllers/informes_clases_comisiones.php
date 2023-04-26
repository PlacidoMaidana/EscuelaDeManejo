<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Exports\Informe_ventasExportComisiones;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromCollection;

class informes_clases_comisiones extends Controller
{
     public function index()
     {
       
        return view('informes.informes_clases_comisiones');
        
     }

     public function en_rango_de_fechas($from,$to)
     {
        return $datos = datatables()->of(DB::table('alumno_evento')
            ->join('alumnos_cursos','alumnos_cursos.id','=','alumno_evento.id_alumno_curso') 
            ->join('cursos','cursos.id','=','alumnos_cursos.id_curso')
            ->join('alumnos','alumnos.id','=','alumnos_cursos.id_alumno')
            ->leftjoin('instructores','instructores.id','=','alumno_evento.id_instructor')
            ->whereBetween('alumno_evento.start_date',array($from,$to) )
            ->groupBy('alumnos.nombre', 'cursos.nombre_curso', 'instructores.nombre', 'instructores.monto_clase')
            ->select([
            'alumnos.nombre',
            'cursos.nombre_curso',
            'instructores.nombre as instructor',
            'instructores.monto_clase',
             DB::raw('COUNT(alumno_evento.id) AS cant_clases'),
             DB::raw('COUNT(alumno_evento.id)* instructores.monto_clase AS comisiones'),  ]))
   ->toJson();  
     }


   public function totalesen_rango_de_fechas($from,$to)      
    { 
            return $totales = datatables()->of(DB::table('alumno_evento')
            ->join('alumnos_cursos','alumnos_cursos.id','=','alumno_evento.id_alumno_curso') 
            ->join('sucursales as s','s.id','=','alumnos_cursos.id_sucursal')
            ->leftjoin('instructores','instructores.id','=','alumno_evento.id_instructor')
            ->whereBetween('alumno_evento.start_date',array($from,$to) )
            ->groupBy('s.sucursal', 'instructores.nombre', 'instructores.monto_clase')
            ->select(['s.sucursal',
                      'instructores.nombre',
                      'instructores.monto_clase',
             DB::raw('COUNT(alumno_evento.id) AS cant_clases'),
             DB::raw('COUNT(alumno_evento.id)* instructores.monto_clase AS comisiones'),  ]))

             ->toJson();  
            
 

    }
    public function export($desde,$hasta,$vendedor) 
    {
      $aa = new Informe_clasesExportComisiones();
      $aa->desde=$desde;
      $aa->hasta=$hasta;
      $aa->vendedor=$vendedor;
       return Excel::download($aa, 'informe_clases_comisiones.xlsx');
     // dd($aa)  ;

    } 
    
}

