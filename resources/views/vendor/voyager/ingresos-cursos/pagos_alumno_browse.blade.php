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
  

{{-- Single delete modal --}}
<div class="modal modal-danger fade" tabindex="-1" id="delete_modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('voyager::generic.close') }}"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="voyager-trash"></i> {{ __('voyager::generic.delete_question') }} {{ strtolower($dataType->getTranslatedAttribute('display_name_singular')) }}?</h4>
            </div>
            <div class="modal-footer">
                <form action="#" id="delete_form" method="POST">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-danger pull-right delete-confirm" value="{{ __('voyager::generic.delete_confirm') }}">
                </form>
                <button type="button" class="btn btn-default pull-right" data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal --> 






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
<script>
    function borrar(id) {
           //alert("Borrando el id"+id);debugger;
           $('#delete_form')[0].action = '{{ route('voyager.'.$dataType->slug.'.destroy', '__id') }}'.replace('__id', id);
           $('#delete_modal').modal('show');
        }
   
</script>


@stop
