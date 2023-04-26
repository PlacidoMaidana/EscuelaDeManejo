<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Exports\Informe_flujofinancieroExport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromCollection;


class informes_flujofinancieroController extends Controller
{
     public function index()
     {
        return view('informes.informes_flujofinanciero');
     }
 
    public function en_rango_de_fechas($anio)
    {
              

            $total_ingresos= DB::table('ingresos_cursos')
                ->select([DB::raw('"INGRESOS TOTAL" as tipo'),
                              DB::raw('" " as tipo1'),
                              DB::raw('" " as tipo2'), 
                              DB::raw('SUM(IF(MONTH(ingresos_cursos.fecha)=1 and year(ingresos_cursos.fecha)= '.$anio.', importe, NULL)) AS Ene'),
                              DB::raw('SUM(IF(MONTH(ingresos_cursos.fecha)=2 and year(ingresos_cursos.fecha)= '.$anio.', importe, NULL)) AS Feb'),
                              DB::raw('SUM(IF(MONTH(ingresos_cursos.fecha)=3 and year(ingresos_cursos.fecha)= '.$anio.', importe, NULL)) AS Mar'),
                              DB::raw('SUM(IF(MONTH(ingresos_cursos.fecha)=4 and year(ingresos_cursos.fecha)= '.$anio.', importe, NULL)) AS Abr'),
                              DB::raw('SUM(IF(MONTH(ingresos_cursos.fecha)=5 and year(ingresos_cursos.fecha)= '.$anio.', importe, NULL)) AS May'),
                              DB::raw('SUM(IF(MONTH(ingresos_cursos.fecha)=6 and year(ingresos_cursos.fecha)= '.$anio.', importe, NULL)) AS Jun'),
                              DB::raw('SUM(IF(MONTH(ingresos_cursos.fecha)=7 and year(ingresos_cursos.fecha)= '.$anio.', importe, NULL)) AS Jul'),
                              DB::raw('SUM(IF(MONTH(ingresos_cursos.fecha)=8 and year(ingresos_cursos.fecha)= '.$anio.', importe, NULL)) AS Ago'),
                              DB::raw('SUM(IF(MONTH(ingresos_cursos.fecha)=9 and year(ingresos_cursos.fecha)= '.$anio.', importe, NULL)) AS Sep'),
                              DB::raw('SUM(IF(MONTH(ingresos_cursos.fecha)=10 and year(ingresos_cursos.fecha)= '.$anio.', importe, NULL)) AS Octu'),
                              DB::raw('SUM(IF(MONTH(ingresos_cursos.fecha)=11 and year(ingresos_cursos.fecha)= '.$anio.', importe, NULL)) AS Nov'),
                              DB::raw('SUM(IF(MONTH(ingresos_cursos.fecha)=12 and year(ingresos_cursos.fecha)= '.$anio.', importe, NULL)) AS Dic')] )
                              ->groupBy('tipo','tipo1','tipo2');

            $total_egresos= DB::table('egresos_gastos')
                             ->select([DB::raw('"EGRESOS TOTAL" as tipo'),
                              DB::raw('" " as tipo1'),
                              DB::raw('" " as tipo2'), 
                                       DB::raw('SUM(IF(MONTH(egresos_gastos.fecha)=1 and year(egresos_gastos.fecha)= '.$anio.', importe*-1, NULL)) AS Ene'),
                                       DB::raw('SUM(IF(MONTH(egresos_gastos.fecha)=2 and year(egresos_gastos.fecha)= '.$anio.', importe*-1, NULL)) AS Feb'),
                                       DB::raw('SUM(IF(MONTH(egresos_gastos.fecha)=3 and year(egresos_gastos.fecha)= '.$anio.', importe*-1, NULL)) AS Mar'),
                                       DB::raw('SUM(IF(MONTH(egresos_gastos.fecha)=4 and year(egresos_gastos.fecha)= '.$anio.', importe*-1, NULL)) AS Abr'),
                                       DB::raw('SUM(IF(MONTH(egresos_gastos.fecha)=5 and year(egresos_gastos.fecha)= '.$anio.', importe*-1, NULL)) AS May'),
                                       DB::raw('SUM(IF(MONTH(egresos_gastos.fecha)=6 and year(egresos_gastos.fecha)= '.$anio.', importe*-1, NULL)) AS Jun'),
                                       DB::raw('SUM(IF(MONTH(egresos_gastos.fecha)=7 and year(egresos_gastos.fecha)= '.$anio.', importe*-1, NULL)) AS Jul'),
                                       DB::raw('SUM(IF(MONTH(egresos_gastos.fecha)=8 and year(egresos_gastos.fecha)= '.$anio.', importe*-1, NULL)) AS Ago'),
                                       DB::raw('SUM(IF(MONTH(egresos_gastos.fecha)=9 and year(egresos_gastos.fecha)= '.$anio.', importe*-1, NULL)) AS Sep'),
                                       DB::raw('SUM(IF(MONTH(egresos_gastos.fecha)=10 and year(egresos_gastos.fecha)= '.$anio.', importe*-1, NULL)) AS Octu'),
                                       DB::raw('SUM(IF(MONTH(egresos_gastos.fecha)=11 and year(egresos_gastos.fecha)= '.$anio.', importe*-1, NULL)) AS Nov'),
                                       DB::raw('SUM(IF(MONTH(egresos_gastos.fecha)=12 and year(egresos_gastos.fecha)= '.$anio.', importe*-1, NULL)) AS Dic')] )
                                       ->groupBy('tipo','tipo1','tipo2');    

                   
            $egresos= DB::table('egresos_gastos')
            ->leftjoin ('tipos_gastos','egresos_gastos.id_tipo_gasto','=','tipos_gastos.id')
            ->join('sucursales','sucursales.id','=','egresos_gastos.id_sucursal')
                       ->select([DB::raw('"EGRESOS" as tipo'),
                             'tipos_gastos.tipo1', 'tipos_gastos.tipo2', 
                              DB::raw('SUM(IF(MONTH(egresos_gastos.fecha)=1 and year(egresos_gastos.fecha)= '.$anio.', importe*-1, NULL)) AS Ene'),
                              DB::raw('SUM(IF(MONTH(egresos_gastos.fecha)=2 and year(egresos_gastos.fecha)= '.$anio.', importe*-1, NULL)) AS Feb'),
                              DB::raw('SUM(IF(MONTH(egresos_gastos.fecha)=3 and year(egresos_gastos.fecha)= '.$anio.', importe*-1, NULL)) AS Mar'),
                              DB::raw('SUM(IF(MONTH(egresos_gastos.fecha)=4 and year(egresos_gastos.fecha)= '.$anio.', importe*-1, NULL)) AS Abr'),
                              DB::raw('SUM(IF(MONTH(egresos_gastos.fecha)=5 and year(egresos_gastos.fecha)= '.$anio.', importe*-1, NULL)) AS May'),
                              DB::raw('SUM(IF(MONTH(egresos_gastos.fecha)=6 and year(egresos_gastos.fecha)= '.$anio.', importe*-1, NULL)) AS Jun'),
                              DB::raw('SUM(IF(MONTH(egresos_gastos.fecha)=7 and year(egresos_gastos.fecha)= '.$anio.', importe*-1, NULL)) AS Jul'),
                              DB::raw('SUM(IF(MONTH(egresos_gastos.fecha)=8 and year(egresos_gastos.fecha)= '.$anio.', importe*-1, NULL)) AS Ago'),
                              DB::raw('SUM(IF(MONTH(egresos_gastos.fecha)=9 and year(egresos_gastos.fecha)= '.$anio.', importe*-1, NULL)) AS Sep'),
                              DB::raw('SUM(IF(MONTH(egresos_gastos.fecha)=10 and year(egresos_gastos.fecha)= '.$anio.', importe*-1, NULL)) AS Octu'),
                              DB::raw('SUM(IF(MONTH(egresos_gastos.fecha)=11 and year(egresos_gastos.fecha)= '.$anio.', importe*-1, NULL)) AS Nov'),
                              DB::raw('SUM(IF(MONTH(egresos_gastos.fecha)=12 and year(egresos_gastos.fecha)= '.$anio.', importe*-1, NULL)) AS Dic')] )
                              ->groupBy('tipo','tipos_gastos.tipo1', 'tipos_gastos.tipo2');

            $egresosingresos= DB::table('ingresos_cursos')
                     ->join ('alumnos_cursos','ingresos_cursos.id_alumno_curso','=','alumnos_cursos.id')
                     ->join('sucursales','sucursales.id','=','alumnos_cursos.id_sucursal')
                     ->join('cursos','cursos.id','=','alumnos_cursos.id_curso')
                               ->select([DB::raw('"INGRESOS" as tipo'),
                                       DB::raw('sucursales.sucursal as tipo1'),
                                       DB::raw('cursos.nombre_curso as tipo2'),
                                       DB::raw('SUM(IF(MONTH(ingresos_cursos.fecha)=1 and year(ingresos_cursos.fecha)= '.$anio.', importe, NULL)) AS Ene'),
                                       DB::raw('SUM(IF(MONTH(ingresos_cursos.fecha)=2 and year(ingresos_cursos.fecha)= '.$anio.', importe, NULL)) AS Feb'),
                                       DB::raw('SUM(IF(MONTH(ingresos_cursos.fecha)=3 and year(ingresos_cursos.fecha)= '.$anio.', importe, NULL)) AS Mar'),
                                       DB::raw('SUM(IF(MONTH(ingresos_cursos.fecha)=4 and year(ingresos_cursos.fecha)= '.$anio.', importe, NULL)) AS Abr'),
                                       DB::raw('SUM(IF(MONTH(ingresos_cursos .fecha)=5 and year(ingresos_cursos.fecha)= '.$anio.', importe, NULL)) AS May'),
                                       DB::raw('SUM(IF(MONTH(ingresos_cursos .fecha)=6 and year(ingresos_cursos.fecha)= '.$anio.', importe, NULL)) AS Jun'),
                                       DB::raw('SUM(IF(MONTH(ingresos_cursos .fecha)=7 and year(ingresos_cursos.fecha)= '.$anio.', importe, NULL)) AS Jul'),
                                       DB::raw('SUM(IF(MONTH(ingresos_cursos .fecha)=8 and year(ingresos_cursos.fecha)= '.$anio.', importe, NULL)) AS Ago'),
                                       DB::raw('SUM(IF(MONTH(ingresos_cursos .fecha)=9 and year(ingresos_cursos.fecha)= '.$anio.', importe, NULL)) AS Sep'),
                                       DB::raw('SUM(IF(MONTH(ingresos_cursos .fecha)=10 and year(ingresos_cursos.fecha)= '.$anio.', importe, NULL)) AS Octu'),
                                       DB::raw('SUM(IF(MONTH(ingresos_cursos.fecha)=11 and year(ingresos_cursos.fecha)= '.$anio.', importe, NULL)) AS Nov'),
                                       DB::raw('SUM(IF(MONTH(ingresos_cursos.fecha)=12 and year(ingresos_cursos.fecha)= '.$anio.', importe, NULL)) AS Dic')] )
                                       ->groupBy('tipo','tipo1', 'tipo2')
                                       ->union($total_egresos)
                                       ->union($egresos)
                                       ->union($total_ingresos);

      return $egresosingresos = datatables()->of($egresosingresos)
               ->toJson();  
           
    }
    
    
    public function export($anio) 
    {
      $aa = new informe_flujofinancieroExport();
      $aa->anio=$anio;
     
       return Excel::download($aa, 'informe_flujo_financiero.xlsx');
      //dd($aa)  ;

    } 
   
    
}

