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
        <th>Alumno</th>
        <th>Curso</th>
        <th>Instructor</th>
        <th>Precio acordado x clase</th>
        <th>Cantidad clases</th>
        <th>Comision</th>
      </tr>
     </thead>
     
    </table>

    <table id="totales" class="table table-striped table-bordered dt-responsive nowrap" style="width:60%">
      <thead>
        <tr>
          <th>Sucursal</th>
          <th>Instructor</th>
          <th>Precio acordado x clase</th>
          <th>Cantidad clases</th>
          <th>Comisiones</th>
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

    var filtro ="{{url('/informeclasesComisiones_rango_de_fechas/')}}"+"/"+$("#fecha_desde").val()+'/'+$("#fecha_hasta").val();
    $('#example').DataTable().destroy();  
    $('#example').dataTable( {
    "serverSide": true,
    "ajax":filtro,
    "paging": true,
    "searching": true,
    "columns":[
            {data: 'nombre', name: 'alumnos.nombre', width: '5%'},
            {data: 'nombre_curso', name: 'cursos.nombre_curso', width: '10%'},
            {data: 'instructor', name: 'instructores.nombre', width: '10%'},
            {data: 'monto_clase', name: 'instructores.monto_clase', render: $.fn.dataTable.render.number(",", ".", 2,'$ '), width: '10%'},
            {data: 'cant_clases', name: 'cant_clases',width: '10%'},
            {data: 'comisiones', name: 'comisiones', render: $.fn.dataTable.render.number(",", ".", 2,'$ '), width: '10%'},
             ]        
});

var filtrototales ="{{url('/totalesclasesComisiones_rango_de_fechas/')}}"+"/"+$("#fecha_desde").val()+'/'+$("#fecha_hasta").val();
  
$('#totales').DataTable().destroy();  
$('#totales').dataTable( {
    "serverSide": true,
    "ajax":filtrototales,
    "paging": false,
    "searching": false,
    "columns":[
            {data: 'sucursal', name: 's.sucursal', width: '5%'},
            {data: 'nombre', name: 'instructores.nombre', width: '5%'},
            {data: 'monto_clase', name: 'instructores.monto_clase', render: $.fn.dataTable.render.number(",", ".", 2,'$ '), width: '10%'},
            {data: 'cant_clases', name: 'cant_clases', width: '10%'},
            {data: 'comisiones', name: 'comisiones', render: $.fn.dataTable.render.number(",", ".", 2,'$ '), width: '10%'},
              ]        
});

  


  }
</script>

<script>
   function excelExport()   {
       window.location.href =  "{{url('/informes_clasesComisiones/export/')}}"+"/"+$("#fecha_desde").val()+'/'+$("#fecha_hasta").val();
   }
</script>


@stop
