<?php

namespace App\Exports;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class Informe_egresosExport implements FromCollection
{
    public $desde;
    public $hasta;
 
   
    public function collection()
    {
       return DB::table('egresos_gastos')
       ->leftjoin ('tipos_gastos','egresos_gastos.id_tipo_gasto','=','tipos_gastos.id')
       ->join('sucursales','sucursales.id','=','egresos_gastos.id_sucursal')
       ->whereBetween('mov_financieros.fecha', array($this->desde,$this->hasta) )
       ->select(['egresos_gastos.fecha',
                 'sucursales.sucursal',
                 'egresos_gastos.descripcion',
                 'egresos_gastos.modalidad_pago',
                 'egresos_gastos.importe',
                 'tipos_gastos.tipo1',
                 'tipos_gastos.tipo2'])
           ->get()  ;
  
    }
}