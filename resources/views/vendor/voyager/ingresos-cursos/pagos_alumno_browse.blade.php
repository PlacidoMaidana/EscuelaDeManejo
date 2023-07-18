 {{--@extends('voyager::master') --}}
  @extends('layouts.voyager2')


@section('page_title', __('voyager::generic.viewing').' '.'Pagos del alumno')


@section('page_header')
    <div class="container-fluid">
        <h1 class="page-title">
            Pagos del Alumno
        </h1>

            <a href="{{url('/create_pago_alumno/'.$id_alumno_curso)}}"  class="btn btn-primary ">Nuevo Pago </a>
    </div>
@stop

@section('content')

                 
<table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
    <thead>
      <tr>
        <th>Nro Recibo</th>
        <th>Alumno</th>
        <th>Curso</th>
        <th>Fecha Pago</th>
        <th>Modalidad Pago</th>
        <th>Importe</th>
        <th>Observaciones</th>
        <th>Acciones</th>
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
             "ajax":" {{url('datos_pagos_alumno/')}}/{{$id_alumno_curso}}",                
             "columns":[
                    {data: 'id', name: 'ingresos_cursos.id', width: '10%'},
                     {data: 'nombre_alumno', name: 'alumnos.nombre', width: '10%'},
                     {data: 'nombre_curso', name: 'cursos.nombre_curso', width: '10%'},
                     {data: 'fecha', name: 'ingresos_cursos.fecha', width: '10%'},
                     {data: 'modalidad_pago', name: 'ingresos_cursos.modalidad_pago', width: '10%'},
                     {data: 'importe', name: 'ingresos_cursos.importe', width: '10%'},
                     {data: 'detalle', name: 'ingresos_cursos.detalle', width: '10%'},
                     {data: 'accion', width: '10%'},
                     ]           
        } );

    } );

   
</script> 



@stop
