<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Exports\informe_ingresosExport;
use App\Exports\informe_egresosExport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromCollection;

class informes_tesoreria extends Controller
{
    
    public function index_ing_suc()
     {
        $total=' ';
        return view('informes.informes_ingresos_sucursal', compact('total'));
     }
     public function index_ing()
     {
        $total=' ';
        return view('informes.informes_ingresos', compact('total'));
     }

     public function index_egr()
     {
        $total=' ';
        return view('informes.informes_egresos', compact('total'));
     }
     public function index_caja_diaria()
     {
        
        $operadores = DB::table('users')->get();
        return view('informes.informes_caja_diaria', compact('operadores'));
     }
     
     
     public function cajadiaria_fecha_operador_egr($fecha,$operador)
     {
      
        return $egresos = datatables()->of(DB::table('egresos_gastos')
            ->leftjoin ('tipos_gastos','egresos_gastos.id_tipo_gasto','=','tipos_gastos.id')
            ->join('sucursales','sucursales.id','=','egresos_gastos.id_sucursal')
            ->where('egresos_gastos.fecha','=',$fecha)
            ->where('egresos_gastos.id_empleado','=',$operador) 
            ->select(['egresos_gastos.fecha',
                      'sucursales.sucursal',
                      'egresos_gastos.descripcion',
                      'egresos_gastos.modalidad_pago',
                      'egresos_gastos.importe',
                      'tipos_gastos.tipo1',
                      'tipos_gastos.tipo2'                     
                        ]))
             ->toJson(); 
     }
      public function cajadiaria_fecha_operador_ing($fecha,$operador)
     {
             return $ingresos = datatables()->of(DB::table('ingresos_cursos')
             ->join ('alumnos_cursos','ingresos_cursos.id_alumno_curso','=','alumnos_cursos.id')
             ->join('sucursales','sucursales.id','=','alumnos_cursos.id_sucursal')
             ->join('alumnos','alumnos.id','=','alumnos_cursos.id_alumno')
             ->join('cursos','cursos.id','=','alumnos_cursos.id_curso')
             ->leftjoin('empleados','empleados.id','=','alumnos_cursos.id_vendedor')
             ->where('ingresos_cursos.fecha','=',$fecha)
             //->where('ingresos_cursos.','=',$operador )
             ->select(['ingresos_cursos.fecha',
                       'sucursales.sucursal',
                       'alumnos.nombre as nombre_alumno',
                       'cursos.nombre_curso',
                       'empleados.nombre',
                       'ingresos_cursos.modalidad_pago',
                       'ingresos_cursos.importe']))
              ->toJson();
             
     }

    public function egr_en_rango_de_fechas($from,$to)
    {
     
       return $datos = datatables()->of(DB::table('egresos_gastos')
           ->leftjoin ('tipos_gastos','egresos_gastos.id_tipo_gasto','=','tipos_gastos.id')
           ->join('sucursales','sucursales.id','=','egresos_gastos.id_sucursal')
           ->whereBetween('egresos_gastos.fecha',array($from,$to) )
           ->select(['egresos_gastos.fecha',
                     'sucursales.sucursal',
                     'egresos_gastos.descripcion',
                     'egresos_gastos.modalidad_pago',
                     'egresos_gastos.importe',
                     'tipos_gastos.tipo1',
                     'tipos_gastos.tipo2',
                    
                       ]))
            ->toJson();  
            $total=DB::table ('egresos_gastos') ->sum('importe') ->whereBetween('egresos_gastos.fecha',array($from,$to) );
             //dd($total);
    }
    public function ing_en_rango_de_fechas($from,$to)
    {

      return $datos = datatables()->of(DB::table('ingresos_cursos')
           ->join ('alumnos_cursos','ingresos_cursos.id_alumno_curso','=','alumnos_cursos.id')
           ->join('sucursales','sucursales.id','=','alumnos_cursos.id_sucursal')
           ->join('alumnos','alumnos.id','=','alumnos_cursos.id_alumno')
           ->join('cursos','cursos.id','=','alumnos_cursos.id_curso')
           ->leftjoin('empleados','empleados.id','=','alumnos_cursos.id_vendedor')
           ->whereBetween('ingresos_cursos.fecha',array($from,$to) )
           ->select(['ingresos_cursos.fecha',
                     'sucursales.sucursal',
                     'alumnos.nombre as nombre_alumno',
                     'cursos.nombre_curso',
                     'empleados.nombre',
                     'ingresos_cursos.modalidad_pago',
                     'ingresos_cursos.importe']))
            ->toJson();   
    }        
    

    public function ing_totales_en_rango_de_fechas($from,$to)
    {
        return $datos = datatables()->of(DB::table('ingresos_cursos')
             ->join('alumnos_cursos','alumnos_cursos.id','=','ingresos_cursos.id_alumno_curso') 
             ->join('sucursales as s','s.id','=','alumnos_cursos.id_sucursal')
             ->whereBetween('ingresos_cursos.fecha',array($from,$to) )
             ->groupBy('s.sucursal')
               ->select([ 's.sucursal',
            DB::raw('SUM(IF(ingresos_cursos.modalidad_pago="Efectivo", importe, NULL)) AS efectivo'),
            DB::raw('SUM(IF(ingresos_cursos.modalidad_pago="Cheque", importe, NULL)) AS cheque'),
            DB::raw('SUM(IF(ingresos_cursos.modalidad_pago="Transferencia", importe, NULL)) AS transferencia'),
            DB::raw('SUM(IF(ingresos_cursos.modalidad_pago="Tarjeta Débito", importe, NULL)) AS tarjeta_debito'),
            DB::raw('SUM(IF(ingresos_cursos.modalidad_pago="Tarjeta Crédito", importe, NULL)) AS tarjeta_credito'),
            DB::raw('SUM(IF(ingresos_cursos.modalidad_pago="Retenciones", importe, NULL)) AS retenciones'),
            DB::raw('SUM(ingresos_cursos.importe) AS total_cobrado'),
              ]))
             ->toJson();  
           
    }
    /////////////// Ingresos por sucursal/////////////////
    public function ing_suc_en_rango_de_fechas($from,$to)
    {

      return $datos = datatables()->of(DB::table('ingresos_cursos')
           ->join ('alumnos_cursos','ingresos_cursos.id_alumno_curso','=','alumnos_cursos.id')
           ->join('sucursales','sucursales.id','=','alumnos_cursos.id_sucursal')
           ->join('alumnos','alumnos.id','=','alumnos_cursos.id_alumno')
           ->join('cursos','cursos.id','=','alumnos_cursos.id_curso')
           ->leftjoin('empleados','empleados.id','=','alumnos_cursos.id_vendedor')
           ->whereBetween('ingresos_cursos.fecha',array($from,$to) )
           ->select(['ingresos_cursos.fecha',
                     'sucursales.sucursal',
                     'alumnos.nombre as nombre_alumno',
                     'cursos.nombre_curso',
                     'empleados.nombre',
                     'ingresos_cursos.modalidad_pago',
                     'ingresos_cursos.importe']))
            ->toJson();   
    }        
    

    public function ing_suc_totales_en_rango_de_fechas($from,$to)
    {
        return $datos = datatables()->of(DB::table('ingresos_cursos')
             ->join('alumnos_cursos','alumnos_cursos.id','=','ingresos_cursos.id_alumno_curso') 
             ->join('sucursales as s','s.id','=','alumnos_cursos.id_sucursal')
             ->whereBetween('ingresos_cursos.fecha',array($from,$to) )
             ->groupBy('s.sucursal')
               ->select([ 's.sucursal',
            DB::raw('SUM(IF(ingresos_cursos.modalidad_pago="Efectivo", importe, NULL)) AS efectivo'),
            DB::raw('SUM(IF(ingresos_cursos.modalidad_pago="Cheque", importe, NULL)) AS cheque'),
            DB::raw('SUM(IF(ingresos_cursos.modalidad_pago="Transferencia", importe, NULL)) AS transferencia'),
            DB::raw('SUM(IF(ingresos_cursos.modalidad_pago="Tarjeta Débito", importe, NULL)) AS tarjeta_debito'),
            DB::raw('SUM(IF(ingresos_cursos.modalidad_pago="Tarjeta Crédito", importe, NULL)) AS tarjeta_credito'),
            DB::raw('SUM(IF(ingresos_cursos.modalidad_pago="Retenciones", importe, NULL)) AS retenciones'),
            DB::raw('SUM(ingresos_cursos.importe) AS total_cobrado'),
              ]))
             ->toJson();  
           
    }
    //////////////////////////////////////////////////////
     public function egr_totales_en_rango_de_fechas($from,$to)
    {
        return $datos = datatables()->of(DB::table('egresos_gastos')
          ->join('sucursales','sucursales.id','=','egresos_gastos.id_sucursal')
          ->whereBetween('egresos_gastos.fecha',array($from,$to) )
             ->groupBy('sucursales.sucursal')
               ->select([ 'sucursales.sucursal',
                    DB::raw('SUM(egresos_gastos.importe) AS total_gastos'),
              ]))
             ->toJson();  
           
    }

   
    public function ing_export($desde,$hasta) 
    {
      $aa = new informe_ingresosExport();
      $aa->desde=$desde;
      $aa->hasta=$hasta;
       return Excel::download($aa, 'informe_ingresos.xlsx');
      //dd($aa)  ;

    } 
    public function egr_export($desde,$hasta) 
    {
      $aa = new informe_egresosExport();
      $aa->desde=$desde;
      $aa->hasta=$hasta;
       return Excel::download($aa, 'informe_egresos.xlsx');
      //dd($aa)  ;

    } 
    
}

