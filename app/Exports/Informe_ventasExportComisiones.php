<?php

namespace App\Exports;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class Informe_ventasExportComisiones implements FromCollection
{
    public $desde;
    public $hasta;
    public $vendedor;
 
    
    public function collection()
    {
       
       return DB::table('nota_pedidos')
          ->join('clientes as c','c.id','=','nota_pedidos.id_cliente')
           ->leftjoin('empleados as v','v.id','=','nota_pedidos.id_vendedor')
           ->whereBetween('nota_pedidos.fecha',array($this->desde,$this->hasta)  )
           ->where('nota_pedidos.id_vendedor','=',$this->vendedor)
          ->select(['nota_pedidos.fecha',
                    'nota_pedidos.tipo_presupuesto', 
                    'c.nombre',
                    'c.cuit',
                    'nota_pedidos.estado',
                    'v.apellidoynombre',
                    'nota_pedidos.totalgravado'  ])
           ->get()  ;
  
    }
}