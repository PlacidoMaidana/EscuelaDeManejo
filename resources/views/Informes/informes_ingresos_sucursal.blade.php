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
      <button  type="button" id="informe ingresos"  onclick="filtrar()" class="btn btn-sm btn-primary" >Filtrar cobranzas</button>
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
        <th>Fecha</th>
        <th>Sucursal</th>
        <th>Alumno</th> 
        <th>Curso</th> 
        <th>Operador caja</th> 
        <th>Modalidad Pago</th>
        <th>Importe</th> 
        <th>Detalle</th>  
        <th>Vendedor</th> 
      </tr>
     </thead>
    </table>

    <table id="totales" class="table table-striped table-bordered dt-responsive nowrap" style="width:60%">
      <thead>
        <tr>
          <th>Sucursal</th> 
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
      
      <table id="saldos" class="table table-striped table-bordered dt-responsive nowrap" style="width:60%">
        <thead>
          <tr>
            <th>Sucursal</th> 
            <th>Saldo pendiente de Cobro</th>
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
   
    var filtro ="{{url('/informeingresos_suc_rango_de_fechas/')}}"+"/"+$("#fecha_desde").val()+'/'+$("#fecha_hasta").val();
    $('#example').DataTable().destroy();
    $('#example').dataTable( {
    "serverSide": true,
    "ajax":filtro,
    "paging": true,
    "searching": true,
    "columns":[
            {data: 'fecha', name: 'ingresos_cursos.fecha', width: '5%'},
            {data: 'sucursal', name: 'sucursales.sucursal', width: '5%'},
            {data: 'nombre_alumno', name: 'alumnos.nombre', width: '10%'},
            {data: 'nombre_curso', name: 'cursos.nombre_curso', width: '10%'},
            {data: 'name', name:'users.name', width: '10%'},
            {data: 'modalidad_pago', name: 'ingresos_cursos.modalidad_pago', width: '10%'},
            {data: 'importe', name: 'ingresos_cursos.importe', width: '10%'},
            {data: 'detalle', name: 'ingresos_cursos.detalle', width: '10%'},
            {data: 'nombre', name: 'empleados.nombre', width: '10%'},
             ]        
});

var filtrototales ="{{url('/totalesingresos_suc_rango_de_fechas/')}}"+"/"+$("#fecha_desde").val()+'/'+$("#fecha_hasta").val();
$('#totales').DataTable().destroy();
$('#totales').dataTable( {
    "serverSide": true,
    "ajax":filtrototales,
    "paging": false,
    "searching": false,
    "columns":[{data: 'sucursal', name: 'sucursales.sucursal', width: '10%'},
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
  
  
  var filtrosaldos_sucursal ="{{url('/informe_saldos_sucursal_operador/')}}";
    $('#saldos').DataTable().destroy();
    $('#saldos').dataTable( {
    "serverSide": true,
    "ajax":filtrosaldos_sucursal,
    "paging": true,
    "searching": true,
    "columns":[
            {data: 'sucursal', name: 'sucursales.sucursal', width: '5%'},
            {data: 'saldosuc', name: 'saldosuc', width: '10%'},
             ]        
});
  
</script>

<script>
   function excelExport()   {
    window.location.href = 'index.php/informes_tesoreria/ing_export/'+$("#fecha_desde").val()+'/'+$("#fecha_hasta").val();
   }
</script>
@stop
