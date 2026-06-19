{{-- @extends('voyager::master') --}}
@extends('layouts.voyager2')

@section('page_title', __('voyager::generic.viewing').' '.'Informe de Movimientos Financieros')

@section('content')



<table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:60%">
    <thead>
      <tr>
        <th>Nombre</th>
        <th>Clases Programadas</th>
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
             "ajax":" {{url('instructores_sucursal/')}}/{{$sucursal}}",                
             "columns":[
                     {data: 'nombre', name: 'instructores.nombre', width: '10%'},
                     {data: 'clases', name: 'clases', width: '10%'},
                     {data: 'accion', width: '10%'},
                      ]           
        } );
    } );

   
</script> 



@stop
