{{-- @extends('voyager::master') --}}
@extends('layouts.voyager2')

@section('page_title', __('voyager::generic.viewing').' '.'Informe de Movimientos Financieros')

@section('content')


<div class="form-group col-md-2 ">
    <label for="">fecha</label>
    <input type="date"  id="fecha" class="form-control" placeholder="" aria-describedby="helpId">
    <small id="helpId" class="text-muted">fecha</small>
</div>

<div class="form-group col-md-2 ">
  <label for="id">Operador</label>
  <select name="listOperador" id="operador_selected">
    @foreach ($operadores as $operador)
        <option value="{{ $operador->id }}">{{ $operador->name }}</option>
    @endforeach
</select>
</div>

<div class="row ">
    <div class="col-md-2  ">
      <button  type="button" id="Movimientos"  onclick="filtrar()" class="btn btn-sm btn-primary" >Ver movimientos caja</button>
    </div>    
</div>
<div class="row ">
  <div class="col-md-2  ">
    <button  type="button" id="ver tesoreria"  onclick="excelExport()" class="btn btn-sm btn-primary" >Excel</button>
  </div>    
</div>
<table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:60%">
    <thead>
      <tr>
        <th>Fecha</th>
        <th>Sucursal</th>
        <th>Detalle</th>
        <th>modalidad_pago</th>
        <th>importe</th>
        <th>Tipo gasto 1</th>
        <th>Tipo gasto 2</th>
      </tr>
     </thead>
     
    </table>
  
    
    <table id="totales" class="table table-striped table-bordered dt-responsive nowrap" style="width:60%">
      <thead>
        <tr>
          <th>Sucursal</th> 
          <th>Operador</th>
          <th>Total Gastos</th>
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
   
    var filtro_egr="{{url('/informe_cajadiaria_fecha_operador_egr/')}}"+"/"+$("#fecha").val()+'/'+$("#operador_selected").val();

    $('#example').dataTable( {
    "serverSide": true,
    "ajax":filtro_egr,
    "paging": true,
    "searching": true,
    "columns":[
            {data: 'fecha', name: 'egresos_gastos.fecha', width: '5%'},
            {data: 'sucursal', name: 'sucursales.sucursal', width: '5%'},
            {data: 'descripcion', name:'egresos_gastos.descripcion', width: '10%'},
            {data: 'modalidad_pago', name: 'egresos_gastos.modalidad_pago', width: '10%'},
            {data: 'importe', name: 'egresos_gastos.importe', width: '10%'},
            {data: 'tipo1', name: 'tipos_gastos.tipo1', width: '10%'},
            {data: 'tipo2', name: 'tipos_gastos.tipo2', width: '10%'},
          ]        
});


var filtrototales ="{{url('/totalesegresos_rango_de_fechas/')}}"+"/"+$("#fecha_desde").val()+'/'+$("#fecha_hasta").val();
  
$('#totales').dataTable( {
    "serverSide": true,
    "ajax":filtrototales,
    "paging": false,
    "searching": false,
    "columns":[{data: 'sucursal', name: 'sucursales.sucursal', width: '10%'},
               {data: 'total_gastos', name: 'total_gastos', width: '10%'},
             ]        
});

   
  }
</script>

<script>
   function excelExport()   {
    window.location.href = '/informes_tesoreria/egr_export/'+$("#fecha_desde").val()+'/'+$("#fecha_hasta").val();
   }
</script>
@stop
