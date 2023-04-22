{{-- @extends('voyager::master') --}}
@extends('layouts.voyager2')

@section('page_title', __('voyager::generic.viewing').' '.'Informe de Ingresos')

@section('content')


<div class="form-group col-md-2 ">
    <label for="">fecha_desde</label>
    <input type="date"  id="fecha_desde" class="form-control" placeholder="" aria-describedby="helpId">
    <small id="helpId" class="text-muted">fecha_desde</small>
</div>
<div class="form-group col-md-2 ">
    <label for="">fecha_hasta</label>
    <input type="date" id="fecha_hasta" class="form-control" placeholder="" aria-describedby="helpId">
    <small id="helpId" class="text-muted">fecha_hasta</small>
</div>

<div class="row ">
    <div class="col-md-2  ">
      <button  type="button" id="informe ingresos"  onclick="filtrar()" class="btn btn-sm btn-primary" >Filtrar movimientos</button>
    </div>    
</div>
<div class="row ">
  <div class="col-md-2  ">
    <button  type="button" id="ver ingresos"  onclick="excelExport()" class="btn btn-sm btn-primary" >Excel</button>
  </div>    
</div>
<table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:60%">
    <thead>
      <tr>
        <th>fecha</th>
        <th>Operador</th>
        <th>nro_recibo</th> 
        <th>modalidad_pago</th>
        <th>detalle</th>
        <th>tipo_movimiento</th>
        <th>Cliente</th>
        <th>importe</th>  
      </tr>
     </thead>
    </table>

    <table id="totales" class="table table-striped table-bordered dt-responsive nowrap" style="width:60%">
      <thead>
        <tr>
          
          <th>Efectivo</th> 
          <th>Cheque</th>
          <th>Transferencia</th>
          <th>Tarjeta Débito</th>
          <th>Tarjeta Crédito</th>
          <th>Retenciones</th>
          <th>Total Cobrado</th>
        </tr>
       </thead>
      
       
      </table>
@stop

@section('css')

@stop

@section('javascript')
    <script>
        $("#btnLimpiar").click(function(event) {
        $("#formFecha")[0].reset();
        });
    </script>


    <script>
    
    $(document).ready(function() {
           

</script> 

<script>

  function filtrar() {
    //var fechas=$("#fecha_desde").val()+"hasta: "+$("#fecha_hasta").val();
    
    var filtro ="{{url('/informeingresos_rango_de_fechas/')}}"+"/"+$("#fecha_desde").val()+'/'+$("#fecha_hasta").val();
  
    $('#example').dataTable( {
    "serverSide": true,
    "ajax":filtro,
    "paging": true,
    "searching": true,
    "columns":[
            {data: 'fecha', name: 'mov_financieros.fecha', width: '5%'},
            {data: 'name', name: 'users.name', width: '5%'},
            {data: 'nro_recibo', name: 'mov_financieros.nro_recibo', width: '10%'},
            {data: 'modalidad_pago', name: 'mov_financieros.modalidad_pago', width: '10%'},
            {data: 'detalle', name:'mov_financieros.detalle', width: '10%'},
            {data: 'tipo_movimiento', name: 'mov_financieros.tipo_movimiento', width: '10%'},
            {data: 'nombre', name: 'clientes.nombre', width: '10%'},
            {data: 'importe_ingreso', name: 'mov_financieros.importe_ingreso', width: '10%'},
             ]        
});

var filtrototales ="{{url('/totalesingresos_rango_de_fechas/')}}"+"/"+$("#fecha_desde").val()+'/'+$("#fecha_hasta").val();
  
    {{-- 
    $('#totales').dataTable( {
        "serverSide": true,
        "ajax":filtrototales,
        "paging": false,
        "searching": false,
        "columns":[
                {data: 'name', name: 'users.name', width: '5%'},
                {data: 'efectivo', name: 'efectivo', width: '10%'},
                {data: 'cheque', name: 'cheque', width: '10%'},
                {data: 'transferencia', name: 'transferencia', width: '10%'},
                {data: 'tarjeta_debito', name: 'tarjeta_debito', width: '10%'},
                {data: 'tarjeta_credito', name: 'tarjeta_credito', width: '10%'},
                {data: 'retenciones', name: 'retenciones', width: '10%'},
                {data: 'total_cobrado', name: 'total_cobrado', width: '10%'},
                ]        
    });   
    --}}
$('#totales').dataTable( {
    "serverSide": true,
    "ajax":filtrototales,
    "paging": false,
    "searching": false,
    "columns":[
            {data: 'efectivo', name: 'efectivo', width: '10%'},
            {data: 'cheque', name: 'cheque', width: '10%'},
            {data: 'transferencia', name: 'transferencia', width: '10%'},
            {data: 'tarjeta_debito', name: 'tarjeta_debito', width: '10%'},
            {data: 'tarjeta_credito', name: 'tarjeta_credito', width: '10%'},
            {data: 'retenciones', name: 'retenciones', width: '10%'},
            {data: 'total_cobrado', name: 'total_cobrado', width: '10%'},
             ]        
});

  }
</script>

<script>
   function excelExport()   {
    window.location.href = '/informes_tesoreria/ing_export/'+$("#fecha_desde").val()+'/'+$("#fecha_hasta").val();
   }
</script>
@stop
