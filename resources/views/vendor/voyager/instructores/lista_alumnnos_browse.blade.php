{{-- @extends('voyager::master') --}}
@extends('layouts.voyager2')

@section('page_title', __('voyager::generic.viewing').' '.'Lista de Alumnos por Instructor')

@section('content')
<h3> Lista de Alumnos del Instructor: {{$nombre_instructor->nombre}}  </h3>

<div class="form-group col-md-2 ">
    <label for="">fecha</label>
    <input type="date"  id="fecha" class="form-control" placeholder="" aria-describedby="helpId">
    <small id="helpId" class="text-muted">fecha</small>
</div>

<div class="row ">
    <div class="col-md-2  ">
      <button  type="button" id="lista alumnos"  onclick="filtrar()" class="btn btn-sm btn-primary" >Buscar Alumnos del dia</button>
    </div>    
</div>
<div class="row ">
  <div class="col-md-2  ">
    <button  type="button" id="excel"  onclick="excelExport()" class="btn btn-sm btn-primary" >Excel </button>
  </div>    
</div>
<table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:60%">
    <thead>
      <tr>
        <th>Fecha y horario</th>
        <th>Alumno</th>
        <th>Telefono</th>
        <th>Curso</th>
        <th>Nro Clase</th>
        <th>Descripcion Clase</th>
        
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
    var filtro ="{{url('/alumnos_instructor_por_fecha/')}}"+"/"+{{$idInstructor}}+"/"+$("#fecha").val();
    console.log(filtro);
    $('#example').dataTable( {
    "serverSide": true,
    "ajax":filtro,
    "paging": true,
    "searching": true,
    "columns":[
            {data: 'start_date', name: 'alumno_evento.start_date', width: '5%'},
            {data: 'nombre', name:'alumnos.nombre', width: '10%'},
            {data: 'telefono', name: 'alumnos.telefono', width: '10%'},
            {data: 'nombre_curso', name: 'cursos.nombre_curso', width: '10%'},
            {data: 'clase', name: 'alumno_evento.clase', width: '10%'},
            {data: 'descripcion', name: 'alumno_evento.descripcion', width: '10%'},
          ]        
});
    
  }
</script>

<script>
    function excelExport()   {
    window.location.href = '/alumnos_instructor/export/'+{{$idInstructor}}+'/'+$("#fecha").val();
   }
</script>
@stop
