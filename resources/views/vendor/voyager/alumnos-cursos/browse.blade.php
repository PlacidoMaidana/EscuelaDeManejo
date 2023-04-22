@extends('voyager::master')

@section('page_title', __('voyager::generic.view').' '.'Calendario de clases'))

@section('page_header')
    {{-- <h1 class="page-title">Cursos</h1>
  --}}
  @can('add', app($dataType->model_name))
  <a href="{{ route('voyager.'.$dataType->slug.'.create') }}" class="btn btn-success btn-add-new">
      <i class="voyager-plus"></i> <span>{{ __('voyager::generic.add_new') }}</span>
  </a>
 
@endcan

@stop

@section('content')

<div class="col-md-12">
    <div class="panel panel-bordered">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                
                 <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#home">Cursos activos</a></li>
                    <li><a data-toggle="tab" href="#menu1">Cursos terminados</a></li>
                    
                  </ul>
                  
                  <div class="tab-content">
                    <div id="home" class="tab-pane fade in active">
                        <table id="cursos_activos" class="table table-striped table-bordered dt-responsive nowrap"  style="width:100%;" >
                            <thead>
                                <tr>
                                    <th class="dt-not-orderable">
                                        <input type="checkbox" class="select_all">
                                    </th>                      
                                    <th>fecha inscripcion</th>
                                    <th>curso</th>
                                    <th>alumno</th>
                                    <th>vendedor</th>
                                    <th>vehiculo</th>
                                    <th>instructor</th>
                                    <th>precio</th>
                                    <th>accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Contenido de la tabla -->
                            </tbody>
                        </table>                                                                                                                                                                                                                       
                    </div>
                    <div id="menu1" class="tab-pane fade">
                        <table id="cursos_terminados" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%;"  >
                            <thead style="width:100%;">
                                <tr style="width:100%;">
                                    <th class="dt-not-orderable">
                                        <input type="checkbox" class="select_all">
                                    </th>
                                    <th>fecha inscripcion</th>
                                    <th>curso</th>
                                    <th>alumno</th>
                                    <th>vendedor</th>
                                    <th>vehiculo</th>
                                    <th>instructor</th>
                                    <th>precio</th>
                                    <th>accion</th>
                                </tr>
                             </thead>
                        </table>
                       

                    </div>
               
                  </div>
                </div>
             </div>
            

             

        </div>    
    </div>
</div>

 

 
@stop

@section('javascript')
 
<script>
    $(document).ready(function() {
        $('#cursos_activos').dataTable( {
             "serverSide": true,
             "scrollCollapse": true,
             "paging": true,
             "searching": true,
             "ordering": true,
             "responsive": true,
             "colReorder": true,
             "orderCellsTop": true,
             "ajax":" {{url('cursos_activos/')}}/{{$sucursal}}",                
             "columns":[
                     {data: 'check', width: '5%'},
                     {data: 'fecha_inscripcion', name: 'alumnos_cursos.fecha_inscripcion', width: '5%'},
                     {data: 'nombre_curso', name: 'cursos.nombre_curso', width: '5%'},
                     {data: 'nombre_alumno', name: 'alumnos.nombre', width: '10%'},
                     {data: 'nombre_vend', name: 'empleados.nombre', width: '10%'},
                     {data: 'marca_modelo_anio', name: 'vehiculos.marca_modelo_anio', width: '10%'},
                     {data: 'nombre_instructor', name: 'instructores.nombre', width: '10%'},
                     {data: 'precio', name: 'alumnos_cursos.precio', width: '10%'},
                     {data: 'accion', width: '10%'},
                      ]           
        } );
    } );

   
</script> 
<script>
    $(document).ready(function() {
        $('#cursos_terminados').dataTable( {
             "serverSide": true,
             "scrollCollapse": true,
             "paging": true,
             "searching": true,
             "ordering": true,
             "responsive": true,
             "colReorder": true,
             "orderCellsTop": true,
             "ajax":"{{url('cursos_terminados/')}}/{{$sucursal}}",                
             "columns":[
                     {data: 'check', width: '5%'},
                     {data: 'fecha_inscripcion', name: 'alumnos_cursos.fecha_inscripcion', width: '5%'},
                     {data: 'nombre_curso', name: 'cursos.nombre_curso', width: '5%'},
                     {data: 'nombre_alumno', name: 'alumnos.nombre', width: '10%'},
                     {data: 'nombre_vend', name: 'empleados.nombre', width: '10%'},
                     {data: 'marca_modelo_anio', name: 'vehiculos.marca_modelo_anio', width: '10%'},
                     {data: 'nombre_instructor', name: 'instructores.nombre', width: '10%'},
                     {data: 'precio', name: 'alumnos_cursos.precio', width: '10%'},
                     {data: 'accion', width: '10%'},
                     
                    ]           
        } );
    } );
 </script> 
@stop


