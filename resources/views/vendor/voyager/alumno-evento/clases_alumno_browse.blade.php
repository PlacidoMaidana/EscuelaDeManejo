{{-- @extends('voyager::master') --}}
@extends('layouts.voyager2')

@section('page_title', __('voyager::generic.viewing').' '.'Informe de Movimientos Financieros')

@section('content')



<table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
    <thead>
      <tr>
        <th class="dt-not-orderable">
          <input type="checkbox" class="select_all">
        </th>
        <th>Alumno</th>
        <th>Curso</th>
        <th>Fecha</th>
        <th>Descripcion Clase</th>
        <th>Tipo Clase</th>
        <th>Instructor</th>
        <th>Asistencia</th>
        <th>Franja Horaria</th>
        <th>accion</th>
      </tr>
     </thead>
     
</table>
  
@stop

@section('css')

@stop

@section('javascript')

<script>
    $(document).ready(function() {
        $('#example').dataTable( {
             "serverSide": true,
             "scrollCollapse": true,
             "paging": true,
             "searching": true,
             "ordering": true,
             "responsive": true,
             "colReorder": true,
             "orderCellsTop": true,  
             "ajax":" {{url('clases_seguimiento_alumno/')}}/{{$id_alumno_curso}}",                
             "columns":[
                     {data: 'check', width: '5%'},
                     {data: 'nombre_alumno', name: 'alumnos.nombre', width: '10%'},
                     {data: 'nombre_curso', name: 'cursos.nombre_curso', width: '10%'},
                     {data: 'fecha', name: 'alumno_evento.start_date', width: '10%'},
                     {data: 'clase', name: 'alumno_evento.descripcion', width: '10%'},
                     {data: 'tipo_evento', name: 'tipos_eventos.tipo_evento', width: '10%'},
                     {data: 'nombre_instructor', name: 'instructores.nombre', width: '10%'},
                     {data: 'asistencia', name: 'alumno_evento.asistencia', width: '10%'},
                     {data: 'descripcion', name: 'franjas_horarias.descripcion', width: '10%'},
                     {data: 'accion', width: '10%'},
                      ]           
        } );
    } );

   
</script> 



@stop
