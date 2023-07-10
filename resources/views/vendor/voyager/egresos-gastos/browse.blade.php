@extends('voyager::master')

@section('page_title', __('voyager::generic.viewing').' '.$dataType->getTranslatedAttribute('display_name_plural'))

@section('page_header')
    <div class="container-fluid">
        @can('add', app($dataType->model_name))
            <a href="{{ route('voyager.'.$dataType->slug.'.create') }}" class="btn btn-success btn-add-new">
                <i class="voyager-plus"></i> <span>{{ __('voyager::generic.add_new') }}</span>
            </a>
        @endcan

       
        @can('edit', app($dataType->model_name))
        @if(!empty($dataType->order_column) && !empty($dataType->order_display_column))
            <a href="{{ route('voyager.'.$dataType->slug.'.order') }}" class="btn btn-primary btn-add-new">
                <i class="voyager-list"></i> <span>{{ __('voyager::bread.order') }}</span>
            </a>
        @endif
        @endcan
        @can('delete', app($dataType->model_name))
        @if($usesSoftDeletes)
            <input type="checkbox" @if ($showSoftDeleted) checked @endif id="show_soft_deletes" data-toggle="toggle" data-on="{{ __('voyager::bread.soft_deletes_off') }}" data-off="{{ __('voyager::bread.soft_deletes_on') }}">
        @endif
        @endcan
        @foreach($actions as $action)
        @if (method_exists($action, 'massAction'))
            @include('voyager::bread.partials.actions', ['action' => $action, 'data' => null])
        @endif
        @endforeach
       @include('voyager::multilingual.language-selector') 
    </div>
@stop

@section('content')
    <div class="page-content browse container-fluid">
        @include('voyager::alerts')
        <div class="row">
            <div class="col-md-12">
                <table id="egresos_sucursal" class="table table-striped table-bordered dt-responsive nowrap"  style="width:100%;" >
                    <thead>
                        <tr>
                            <th class="dt-not-orderable">
                                <input type="checkbox" class="select_all">
                            </th>                      
                            <th>fecha</th>
                            <th>Tipo gasto 1</th>
                            <th>Tipo gasto 2</th>
                            <th>descripcion</th>
                            <th>operador</th>
                            <th>modalidad pago</th>
                            <th>importe</th>
                            <th>accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Contenido de la tabla -->
                    </tbody>                
                </table>  

            </div>
        </div>
    </div>

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
@if(!$dataType->server_side && config('dashboard.data_tables.responsive'))
    <link rel="stylesheet" href="{{ voyager_asset('lib/css/responsive.dataTables.min.css') }}">
@endif

@section('javascript')
    <!-- DataTables -->

    <script>
        $(document).ready(function () {
            $('#egresos_sucursal').dataTable( {
             "serverSide": true,
             "scrollCollapse": true,
             "paging": true,
             "searching": true,
             "ordering": true,
             "responsive": true,
             "colReorder": true,
             "orderCellsTop": true,
             "ajax":"{{url('egresos_por_sucursal/')}}/{{$sucursal}}",                
             "columns":[
                     {data: 'check', width: '5%'},
                     {data: 'fecha', name: 'egresos_gastos.fecha', width: '5%'},
                     {data: 'tipo1', name: 'tipos_gastos.tipo1', width: '5%'},
                     {data: 'tipo2', name: 'tipos_gastos.tipo2', width: '10%'},
                     {data: 'descripcion', name: 'egresos_gastos.descripcion', width: '10%'},
                     {data: 'name', name: 'users.name', width: '10%'},
                     {data: 'modalidad_pago', name: 'egresos_gastos.modalidad_pago', width: '10%'},
                     {data: 'importe', name: 'egresos_gastos.importe', width: '10%'},
                     {data: 'accion', width: '10%'},
                     
                    ]           
        } );
    } );
 </script> 
<script>
    function borrar(id) {
        $('#delete_form')[0].action = '{{ route('voyager.'.$dataType->slug.'.destroy', '__id') }}'.replace('__id', id);
        $('#delete_modal').modal('show');
    }
    </script>


@stop

