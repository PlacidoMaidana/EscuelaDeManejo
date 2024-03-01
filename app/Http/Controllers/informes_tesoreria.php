<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Exports\Informe_ingresosExport;
use App\Exports\Informe_egresosExport;
use App\Exports\Informe_cajaExport;
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
     
     public function index_caja_diaria_operador()
     {
        $operador = auth()->user()->id;
        
        return view('informes.informes_caja_diaria_operador', compact('operador'));
     }
     
     public function cajadiaria_fecha_operador_egr($fecha,$operador)
     {
      
        return $egresos = datatables()->of(DB::table('egresos_gastos')
            ->leftjoin ('tipos_gastos','egresos_gastos.id_tipo_gasto','=','tipos_gastos.id')
            ->join('sucursales','sucursales.id','=','egresos_gastos.id_sucursal')
            ->join('users','users.id','=','egresos_gastos.id_empleado')
            ->where('egresos_gastos.fecha','=',$fecha)
            ->where('egresos_gastos.id_empleado','=',$operador) 
            ->select(['egresos_gastos.fecha',
                      'sucursales.sucursal',
                      'users.name',
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
             ->join('users','users.id','=','ingresos_cursos.id_usuario')
             ->join('alumnos','alumnos.id','=','alumnos_cursos.id_alumno')
             ->join('cursos','cursos.id','=','alumnos_cursos.id_curso')
             ->where('ingresos_cursos.fecha','=',$fecha)
             ->where('ingresos_cursos.id_usuario','=',$operador )
             ->select(['ingresos_cursos.fecha',
                       'sucursales.sucursal',
                       'users.name',
                       'ingresos_cursos.modalidad_pago',
                       'ingresos_cursos.importe',
                       'alumnos.nombre',
                       'cursos.nombre_curso'
                       ]))
              ->toJson();
             
     }

     public function cajadiaria_fecha_operador_totales($fecha,$operador)
     {
      
      
      $total_ingresos= DB::table('ingresos_cursos')
              ->whereDate('ingresos_cursos.fecha','=', $fecha) 
              ->where('ingresos_cursos.id_usuario','=', $operador)
                    ->select([DB::raw('"INGRESOS" as tipo'),
                    DB::raw('SUM(IF(ingresos_cursos.modalidad_pago="Efectivo", importe, NULL)) AS Efectivo'),
                    DB::raw('SUM(IF(ingresos_cursos.modalidad_pago="Transferencia", importe, NULL)) AS Transferencia'),
                    DB::raw('SUM(IF(ingresos_cursos.modalidad_pago="Tarjeta Débito" , importe, NULL)) AS Debito'),
                    DB::raw('SUM(IF(ingresos_cursos.modalidad_pago="Tarjeta Crédito", importe, NULL)) AS Credito'), 
                    DB::raw('SUM(IF(ingresos_cursos.modalidad_pago="Mercado Pago", importe, NULL)) AS MPago'),  ])
                    ->groupBy('tipo');
         

      $egresosingresos= DB::table('egresos_gastos')
                    ->whereDate('egresos_gastos.fecha','=', $fecha) 
                    ->where('egresos_gastos.id_empleado','=', $operador)
                    ->select([DB::raw('"EGRESOS" as tipo'),
                    DB::raw('SUM(IF(egresos_gastos.modalidad_pago="Efectivo" , importe, NULL)) AS Efectivo'),
                    DB::raw('SUM(IF(egresos_gastos.modalidad_pago="Transferencia", importe, NULL)) AS Transferencia'),
                    DB::raw('SUM(IF(egresos_gastos.modalidad_pago="Tarjeta Débito" , importe, NULL)) AS Debito'),
                    DB::raw('SUM(IF(egresos_gastos.modalidad_pago="Tarjeta Crédito", importe, NULL)) AS Credito'),
                    DB::raw('SUM(IF(egresos_gastos.modalidad_pago="Mercado Pago", importe, NULL)) AS MPago'), ] )
                    ->groupBy('tipo')
                    ->union($total_ingresos);
   
      return $egresosingresos = datatables()->of($egresosingresos)
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
            
    }
    public function ing_en_rango_de_fechas($from,$to)
    {

      return $datos = datatables()->of(DB::table('ingresos_cursos')
           ->join ('alumnos_cursos','ingresos_cursos.id_alumno_curso','=','alumnos_cursos.id')
           ->join('alumnos','alumnos.id','=','alumnos_cursos.id_alumno')
           ->join('cursos','cursos.id','=','alumnos_cursos.id_curso')
           ->leftjoin('users','users.id','=','ingresos_cursos.id_usuario')
           ->join('sucursales','sucursales.id','=','users.id_sucursal')
           ->whereBetween('ingresos_cursos.fecha',array($from,$to) )
           ->select(['ingresos_cursos.fecha',
                     'sucursales.sucursal',
                     'alumnos.nombre as nombre_alumno',
                     'cursos.nombre_curso',
                     'users.name',
                     'ingresos_cursos.modalidad_pago',
                     'ingresos_cursos.importe',
                     'ingresos_cursos.detalle'
                     ]))
            ->toJson();   
    }        
    

    public function ing_totales_en_rango_de_fechas($from,$to)
    {
        return $datos = datatables()->of(DB::table('ingresos_cursos')
            ->leftjoin('users','users.id','=','ingresos_cursos.id_usuario')
            ->join('sucursales','sucursales.id','=','users.id_sucursal')
             ->whereBetween('ingresos_cursos.fecha',array($from,$to) )
             ->groupBy('sucursales.sucursal')
               ->select([ 'sucursales.sucursal',
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

    public function saldos_acobrar_porsucursal()
    {
     $saldos_alumnos= DB::table('ingresos_cursos as i')
              ->join('alumnos_cursos as a', 'a.id', '=', 'i.id_alumno_curso')
              ->join('users', 'users.id', '=', 'i.id_usuario')
              ->select('users.id_sucursal', 'a.id', DB::raw('(a.precio - SUM(i.importe)) as saldo'))
              ->groupBy('users.id_sucursal', 'a.id','a.precio')
              ->havingRaw('a.precio - SUM(i.importe) > 0');

    return $resultado = datatables()->of( DB::table('sucursales')
      ->joinSub($saldos_alumnos, 'b' , function ($join) {
        $join-> on('sucursales.id', '=', 'b.id_sucursal');})
      ->groupBy('sucursales.sucursal')
      ->select('sucursales.sucursal', DB::raw('SUM(b.saldo) as saldosuc')))
      ->toJson();
    }

    public function saldos_acobrar_sucursal_operador()
    {
      $sucursal = auth()->user()->id_sucursal;
      $saldos_alumnos= DB::table('ingresos_cursos as i')
              ->join('alumnos_cursos as a', 'a.id', '=', 'i.id_alumno_curso')
              ->join('users', 'users.id', '=', 'i.id_usuario')
              ->select('users.id_sucursal', 'a.id', DB::raw('(a.precio - SUM(i.importe)) as saldo'))
              ->where('users.id_sucursal','=',$sucursal)
              ->groupBy('users.id_sucursal', 'a.id','a.precio')
              ->havingRaw('a.precio - SUM(i.importe) > 0');
      return $resultado = datatables()->of( DB::table('sucursales')
              ->joinSub($saldos_alumnos, 'b' , function ($join) {
                $join-> on('sucursales.id', '=', 'b.id_sucursal');})
              ->groupBy('sucursales.sucursal')
              ->select('sucursales.sucursal', DB::raw('SUM(b.saldo) as saldosuc')))
              ->toJson();
    
    }
    
    /////////////// Ingresos por sucursal/////////////////
    public function ing_suc_en_rango_de_fechas($from,$to)
    {
      $sucursal = auth()->user()->id_sucursal;
     
      return $datos = datatables()->of(DB::table('ingresos_cursos')
           ->join ('alumnos_cursos','ingresos_cursos.id_alumno_curso','=','alumnos_cursos.id')
           ->leftjoin ('empleados','empleados.id','=','alumnos_cursos.id_vendedor' )
           ->join('alumnos','alumnos.id','=','alumnos_cursos.id_alumno')
           ->join('cursos','cursos.id','=','alumnos_cursos.id_curso')
           ->leftjoin('users','users.id','=','ingresos_cursos.id_usuario')
           ->join('sucursales','sucursales.id','=','users.id_sucursal')
           ->whereBetween('ingresos_cursos.fecha',array($from,$to) )
           ->where('users.id_sucursal','=',$sucursal)
           ->select(['ingresos_cursos.fecha',
                     'sucursales.sucursal',
                     'alumnos.nombre as nombre_alumno',
                     'cursos.nombre_curso',
                     'users.name',
                     'ingresos_cursos.modalidad_pago',
                     'ingresos_cursos.importe',
                     'ingresos_cursos.detalle',
                     'empleados.nombre' ]))
            ->toJson();   
    }        
    

    public function ing_suc_totales_en_rango_de_fechas($from,$to)
    {
        $sucursal = auth()->user()->id_sucursal;
        return $datos = datatables()->of(DB::table('ingresos_cursos')
        ->leftjoin('users','users.id','=','ingresos_cursos.id_usuario')
        ->join('sucursales','sucursales.id','=','users.id_sucursal')
             ->whereBetween('ingresos_cursos.fecha',array($from,$to) )
             ->where('users.id_sucursal','=',$sucursal)
             ->groupBy('sucursales.sucursal')
               ->select([ 'sucursales.sucursal',
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
       return Excel::download($aa, 'informe_caja_diaria.xlsx');
      //dd($aa)  ;

    } 

    public function caja_export($fecha,$operador) 
    {
      $aa = new Informe_cajaExport();
      $aa->fecha=$fecha;
      $aa->operador=$operador;
       return Excel::download($aa, 'informe_egresos.xlsx');
      //dd($aa)  ;

    } 
    
}

