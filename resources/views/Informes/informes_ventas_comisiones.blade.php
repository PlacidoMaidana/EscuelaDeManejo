{{-- @extends('voyager::master') --}}
@extends('layouts.voyager2')

@section('page_title', __('voyager::generic.viewing').' '.'Informe de Ventas para calculo de comisiones')

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
{{-- 
<div class="form-group col-md-2"   data-select2-id="js-example-data-array">
  <label class="control-label" for="name">Vendedor</label>
  <select class="form-control select2-array " data:{{$vendedores}}>
</select> 
</div>


  <div class="form-group  col-md-2 " data-select2-id="18">
  <label class="control-label" for="name">Vendedor</label>
  <select class="form-control select2-ajax select2-hidden-accessible" id="id_vendedor" data-get-items-route="admin/nota-pedidos/relation" data-get-items-field="nota_pedido_belongsto_empleado_relationship" data-id="66" data-method="edit"  tabindex="-1" aria-hidden="true">
   </select>
</div>
--}}

<div class="form-group  col-md-6 ">
                                          
  <label class="control-label" for="name">Vendedor</label>
  <select class="form-control select2-ajax select2-hidden-accessible" id="id_vendedor" data-get-items-route="http://c1561704.ferozo.com/persia/public/admin/nota-pedidos/relation" data-get-items-field="nota_pedido_belongsto_empleado_relationship_1" data-id="121" data-method="edit"  tabindex="-1" data-select2-id="id_vendedor" aria-hidden="true">
  </select>
</div>

{{-- 
<div class="form-group  col-md-2 " data-select2-id="18">
  <label class="control-label" for="name">Vendedor</label>
  <select class="form-control select2-ajax select2-hidden-accessible" id="id_vendedor" data-get-items-route="admin/nota-pedidos/relation" data-get-items-field="nota_pedido_belongsto_empleado_relationship" data-id="66" data-method="edit" tabindex="-1" aria-hidden="true" data-select2-id="id_vendedor">
  </select>
</div>
--}}
<div class="row ">
    <div class="col-md-2  ">
      <button  type="button" id="informe_vtas"  onclick="filtrar()" class="btn btn-sm btn-primary" >Filtrar ventas</button>
    </div>    
</div>
<div class="row ">
  <div class="col-md-2  ">
    <button  type="button" id="ver ventas"  onclick="excelExport()" class="btn btn-sm btn-primary" >Excel</button>
  </div>    
</div>
<table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:60%">
    <thead>
      <tr>
        <th>fecha</th>
        <th>tipo presupuesto</th>
        <th>cliente</th>
        <th>cuit</th>
        <th>estado</th>
        <th>vendedor1</th>
        <th>vendedor2</th>
        <th>Subtotal sin IVA</th>
      </tr>
     </thead>
     
    </table>

    <table id="totales" class="table table-striped table-bordered dt-responsive nowrap" style="width:60%">
      <thead>
        <tr>
          <th>tipo_presupuesto</th>
          <th>% Comision</th>
          <th>Pendientes de Entrega</th>
          <th>Entregados</th>
          <th>Total ventas</th>
          <th>Importe Comision</th>
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
    var filtro ="{{url('/informevtasComisiones_rango_de_fechas/')}}"+"/"+$("#fecha_desde").val()+'/'+$("#fecha_hasta").val()+'/'+$("#id_vendedor").val();
  
    
    $('#example').dataTable( {
    "serverSide": true,
    "ajax":filtro,
    "paging": true,
    "searching": true,
    "columns":[
            {data: 'fecha', name: 'nota_pedidos.fecha', width: '5%'},
            {data: 'tipo_presupuesto', name: 'nota_pedidos.tipo_presupuesto', width: '5%'},
            {data: 'nombre', name: 'c.nombre', width: '10%'},
            {data: 'cuit', name: 'c.cuit', width: '10%'},
            {data: 'estado', name: 'nota_pedidos.estado',width: '10%'},
            {data: 'apellidoynombre', name:'v.apellidoynombre',width: '10%'},
            {data: 'apellidoynombre', name:'v2.apellidoynombre',width: '10%'},
            {data: 'totalgravado', name: 'nota_pedidos.totalgravado', render: $.fn.dataTable.render.number(",", ".", 2,'$ '), width: '10%'},
             ]        
});

var filtrototales ="{{url('/totalesvtasComisiones_rango_de_fechas/')}}"+"/"+$("#fecha_desde").val()+'/'+$("#fecha_hasta").val()+'/'+$("#id_vendedor").val();
  
 
$('#totales').dataTable( {
    "serverSide": true,
    "ajax":filtrototales,
    "paging": false,
    "searching": false,
    "columns":[
            {data: 'tipo_presupuesto', name: 'nota_pedidos.tipo_presupuesto', width: '5%'},
            {data: 'porc_comision', name: 'porc_comision', width: '5%'},
            {data: 'Pendiente_Entrega', name: 'Pendiente_Entrega', render: $.fn.dataTable.render.number(",", ".", 2,'$ '), width: '10%'},
            {data: 'Entregado', name: 'Entregado', render: $.fn.dataTable.render.number(",", ".", 2,'$ '), width: '10%'},
            {data: 'total_ventas', name: 'total_ventas', render: $.fn.dataTable.render.number(",", ".", 2,'$ '), width: '10%'},
            {data: 'comision', name: 'comision', render: $.fn.dataTable.render.number(",", ".", 2,'$ '), width: '10%'},
              ]        
});

  


  }
</script>

<script>
   function excelExport()   {
       window.location.href =  "{{url('/informes_ventasComisiones/export/')}}"+"/"+$("#fecha_desde").val()+'/'+$("#fecha_hasta").val()+'/'+$("#id_vendedor").val();
   }
</script>


@stop
