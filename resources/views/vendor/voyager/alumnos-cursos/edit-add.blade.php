@php
    use App\Sucursale;
    $edit = !is_null($dataTypeContent->getKey());
    $add  = is_null($dataTypeContent->getKey());
@endphp

@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @livewireStyles
@stop

@section('page_title', __('voyager::generic.'.($edit ? 'edit' : 'add')).' '.$dataType->getTranslatedAttribute('display_name_singular'))

@section('page_header')
    <h1 class="page-title">
        DATOS DE LA INSCRIPCION
        <i class="{{ $dataType->icon }}"></i>
    </h1>
    @include('voyager::multilingual.language-selector')
@stop




@section('content')
    <div class="page-content edit-add container-fluid">
        <div class="row">
            <div class="col-md-12">
                Sucursal: {{$nombre_sucursal[0]->sucursal}} <br>
                <div class="panel panel-bordered">
                    <!-- form start -->
                    <form role="form"
                            class="form-edit-add"
                            action="{{ $edit ? route('voyager.'.$dataType->slug.'.update', $dataTypeContent->getKey()) : route('voyager.'.$dataType->slug.'.store') }}"
                            method="POST" enctype="multipart/form-data">
                        <!-- PUT Method if we are editing -->
                        @if($edit)
                            {{ method_field("PUT") }}
                        @endif

                        <!-- CSRF TOKEN -->
                        {{ csrf_field() }}

                        <div class="panel-body">

                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <!-- Adding / Editing -->
                            @php
                                $dataTypeRows = $dataType->{($edit ? 'editRows' : 'addRows' )};
                              
                            @endphp
                          
                            @for ($i = 0; $i < count($dataTypeRows); $i++)
                                <!-- GET THE DISPLAY OPTIONS -->
                                @php
                                $row=$dataTypeRows[$i];
                                    $display_options = $row->details->display ?? NULL;
                                    if ($dataTypeContent->{$row->field.'_'.($edit ? 'edit' : 'add')}) {
                                        $dataTypeContent->{$row->field} = $dataTypeContent->{$row->field.'_'.($edit ? 'edit' : 'add')};
                                    }
                                @endphp
                                @if (isset($row->details->legend) && isset($row->details->legend->text))
                                    <legend class="text-{{ $row->details->legend->align ?? 'center' }}" style="background-color: {{ $row->details->legend->bgcolor ?? '#f0f0f0' }};padding: 5px;">{{ $row->details->legend->text }}</legend>
                                @endif
                               
                                @if ($row->getTranslatedAttribute('display_name')=='cursos')
                                              
                                <div class="form-group @if($row->type == 'hidden') hidden @endif col-md-{{ $display_options->width ?? 12 }} {{ $errors->has($row->field) ? 'has-error' : '' }}" @if(isset($display_options->id)){{ "id=$display_options->id" }}@endif>
                                   {{ $row->slugify }}
                                   <label class="control-label" for="name">{{ $row->getTranslatedAttribute('display_name') }}
                                        
                                   </label>                                 
                                    @php
                                         foreach ($cursos as $curso)
                                         {
                                         if ($curso->id==$dataTypeContent->id_curso) {
                                         $nombrecurso=$curso->nombre_curso;   
                                         }
                                         }
                                         
                                    @endphp
                                       
                                   <select name="id_curso" class="form-control " id="id_curso" onchange="actualizarPrecio()">
                                    @if($edit)
                                    <option selected value ="{{$dataTypeContent->id_curso}}">{{$nombrecurso}} </option>
                                        
                                    @endif
                               
                                    @foreach ($cursos as $curso)
                                   <option value="{{ $curso->id }}" data-precio="{{ $curso->precio_curso }}">{{ $curso->nombre_curso }}</option>
                                       @endforeach
                                   </select>                                                     
                                    
                               </div>
                                
                               @php
                                   continue;
                               @endphp
                               @endif
{{--  
                               @if ($row->getTranslatedAttribute('display_name')=='sucursales')
                                    @php
                                    $user=auth()->user();
                                    $sucursal=$user->id_sucursal;
                                    $registro = Sucursale::find($sucursal);
                                    @endphp    
                                
                                                  
                                    <div class="form-group @if($row->type == 'hidden') hidden @endif col-md-{{ $display_options->width ?? 12 }} {{ $errors->has($row->field) ? 'has-error' : '' }}" @if(isset($display_options->id)){{ "id=$display_options->id" }}@endif>
                                        {{ $row->slugify }}
                                        <label class="control-label" for="name">Sucursal: {{ $registro->sucursal}}
                                        </label>
                                        <div class="form-group  col-md-12 ">     
                                            <input type="text" class="form-control"  id='sucursal'  name="id_sucursal" placeholder="sucursal" value="{{ $registro->id}}" readonly >
                                        </div>                              
                                            
                                    </div>

                                        @php
                                            continue;
                                        @endphp
                                                              
                                @endif
                          --}} 
                            @if ($add )
                             @if($row->getTranslatedAttribute('display_name')=='sucursales')
                               <input type="hidden" name="id_sucursal" value="{{$sucursal}}">
                                @php
                                    continue;
                                @endphp
                             @endif                      
                            @endif

                            @if ($row->getTranslatedAttribute('display_name')=='alumnos')
                                                {{-- <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
                                                <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<      Boton + Alumno          <<<<<<<<<<<<<<<<<<<<<<<<<
                                                <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<                              <<<<<<<<<<<<<<<<<<<<<<<<
                                                <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< --}}
                                                          <!-- Modal -->
                                                             <div class="modal fade modal-warning" id="modal_alumno" v-if="allowCrop">
                                                               <div class="modal-dialog"  style="min-width: 50%">
                                                                   <div class="modal-content">
                                                                       <div class="modal-header">
                                                                           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                           <h4 class="modal-title">Nuevo alumno</h4>
                                                                       </div>
                                                                       <div id="x34" class="modal-body">
                                                                           <livewire:ficha-alumno /> 
                                                                       </div>
                                                                       <div class="modal-footer">
                                                                           <button type="button" id="salir" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                                       </div>
                                                                   </div>
                                                               </div>
                                                             </div>	

                                                 <div class="form-group @if($row->type == 'hidden') hidden @endif col-md-{{ $display_options->width ?? 12 }} {{ $errors->has($row->field) ? 'has-error' : '' }}" @if(isset($display_options->id)){{ "id=$display_options->id" }}@endif>
                                                    {{ $row->slugify }}
                                                    <label class="control-label" for="name">{{ $row->getTranslatedAttribute('display_name') }}
                                                          <!-- Button trigger modal -->
                                                          <button type="button" id="alumno" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_alumno">
                                                            + Alumno
                                                          </button>
                                                    </label>

                                                    <button type="button" id="boton_elegir_alumno" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_alumno_elegir">
                                                        Buscar Alumno
                                                    </button>
                                                     
                                                        <input type="hidden" id="id_alumno" name="id_alumno"  value="{{$id_alumno}}" >
                                                        
                                                        
                                                        <input type="text"  id="alumno_elegido" name="alumno_elegido" required readonly value="{{$nombre_alumno}}" style="WIDTH: 550px" >
                                                 
                                                </div>
                                                 
                                                @php
                                                    continue;
                                                @endphp
                            @endif

                                       {{--  >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  --}}
                                       {{-- >>>>>>>>>>>>>>>>>>>>>>   ALUMNOS   >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  --}}
                                       {{-- >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  --}}
                                       
                                       <div class="modal fade modal-warning" id="modal_alumno_elegir" v-if="allowCrop">
                                        <div class="modal-dialog"  style="min-width: 90%">
                                            <div class="modal-content">
                                           
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    <h4 class="modal-title">Seleccione un Alumno</h4>
                                                </div>
                                            
                                                <div id="x34" class="modal-body">
                                                    <div class="card" style="min-width: 70%">
                                                        <img class="card-img-top" src="holder.js/100x180/" alt="">
                                                        <div class="card-body">
                                                           <h4 class="card-title">Elegir Alumnos</h4>
                                                           <table id="AlumnosTable" class="table table-striped table-bordered dt-responsive nowrap" style="width:60%">
                                                            <thead>
                                                              <tr>
                                                                  <th>id</th>
                                                                  <th>Nombre</th>
                                                                  <th>Direccion</th>
                                                                  <th>Mail</th>
                                                                  <th>Telefono</th>
                                                                  <th>seleccionar</th>
                                                              </tr>
                                                             </thead>
                                                           </table>    
                                                        </div>
                                                    </div>
                                                </div>
                                            
                                                <div class="modal-footer">
                                                    <button type="button" id="salir" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                       </div>

                                       {{-- <<<<<<<<<<<<<<<<<<<<<<<    FIN MODAL ALUMNOS    >>>>>>>>>>>>>>>>>>>>>>>>>>>> --}}
                                       {{-- >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  --}}
                                       {{-- >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  --}}                                  

                                <div class="form-group @if($row->type == 'hidden') hidden @endif col-md-{{ $display_options->width ?? 12 }} {{ $errors->has($row->field) ? 'has-error' : '' }}" @if(isset($display_options->id)){{ "id=$display_options->id" }}@endif>
                                    {{ $row->slugify }}
                                    <label class="control-label" for="name">{{ $row->getTranslatedAttribute('display_name') }}</label>
                                    @include('voyager::multilingual.input-hidden-bread-edit-add')
                                    @if (isset($row->details->view))
                                        @include($row->details->view, ['row' => $row, 'dataType' => $dataType, 'dataTypeContent' => $dataTypeContent, 'content' => $dataTypeContent->{$row->field}, 'action' => ($edit ? 'edit' : 'add'), 'view' => ($edit ? 'edit' : 'add'), 'options' => $row->details])
                                    @elseif ($row->type == 'relationship')
                                        @include('voyager::formfields.relationship', ['options' => $row->details])
                                    @else
                                        {!! app('voyager')->formField($row, $dataType, $dataTypeContent) !!}
                                    @endif

                                    @foreach (app('voyager')->afterFormFields($row, $dataType, $dataTypeContent) as $after)
                                        {!! $after->handle($row, $dataType, $dataTypeContent) !!}
                                    @endforeach
                                    @if ($errors->has($row->field))
                                        @foreach ($errors->get($row->field) as $error)
                                            <span class="help-block">{{ $error }}</span>
                                        @endforeach
                                    @endif
                                </div>
                                
                              
                                

                            @endfor

                        </div><!-- panel-body -->

                        <div class="panel-footer">
                            @section('submit-buttons')
                                <button type="submit" class="btn btn-primary save">{{ __('voyager::generic.save') }}</button>
                            @stop
                            @yield('submit-buttons')
                        </div>
                    </form>

                    <iframe id="form_target" name="form_target" style="display:none"></iframe>
                    <form id="my_form" action="{{ route('voyager.upload') }}" target="form_target" method="post"
                            enctype="multipart/form-data" style="width:0;height:0;overflow:hidden">
                        <input name="image" id="upload_file" type="file"
                                 onchange="$('#my_form').submit();this.value='';">
                        <input type="hidden" name="type_slug" id="type_slug" value="{{ $dataType->slug }}">
                        {{ csrf_field() }}
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-danger" id="confirm_delete_modal">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="voyager-warning"></i> {{ __('voyager::generic.are_you_sure') }}</h4>
                </div>

                <div class="modal-body">
                    <h4>{{ __('voyager::generic.are_you_sure_delete') }} '<span class="confirm_delete_name"></span>'</h4>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
                    <button type="button" class="btn btn-danger" id="confirm_delete">{{ __('voyager::generic.delete_confirm') }}</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Delete File Modal -->
    @livewireScripts
@stop

@section('javascript')
    <script>
        var params = {};
        var $file;

        function deleteHandler(tag, isMulti) {
          return function() {
            $file = $(this).siblings(tag);

            params = {
                slug:   '{{ $dataType->slug }}',
                filename:  $file.data('file-name'),
                id:     $file.data('id'),
                field:  $file.parent().data('field-name'),
                multi: isMulti,
                _token: '{{ csrf_token() }}'
            }

            $('.confirm_delete_name').text(params.filename);
            $('#confirm_delete_modal').modal('show');
          };
        }

        $('document').ready(function () {
            $('.toggleswitch').bootstrapToggle();

            //Init datepicker for date fields if data-datepicker attribute defined
            //or if browser does not handle date inputs
            $('.form-group input[type=date]').each(function (idx, elt) {
                if (elt.hasAttribute('data-datepicker')) {
                    elt.type = 'text';
                    $(elt).datetimepicker($(elt).data('datepicker'));
                } else if (elt.type != 'date') {
                    elt.type = 'text';
                    $(elt).datetimepicker({
                        format: 'L',
                        extraFormats: [ 'YYYY-MM-DD' ]
                    }).datetimepicker($(elt).data('datepicker'));
                }
            });

            @if ($isModelTranslatable)
                $('.side-body').multilingual({"editing": true});
            @endif

            $('.side-body input[data-slug-origin]').each(function(i, el) {
                $(el).slugify();
            });

            $('.form-group').on('click', '.remove-multi-image', deleteHandler('img', true));
            $('.form-group').on('click', '.remove-single-image', deleteHandler('img', false));
            $('.form-group').on('click', '.remove-multi-file', deleteHandler('a', true));
            $('.form-group').on('click', '.remove-single-file', deleteHandler('a', false));

            $('#confirm_delete').on('click', function(){
                $.post('{{ route('voyager.'.$dataType->slug.'.media.remove') }}', params, function (response) {
                    if ( response
                        && response.data
                        && response.data.status
                        && response.data.status == 200 ) {

                        toastr.success(response.data.message);
                        $file.parent().fadeOut(300, function() { $(this).remove(); })
                    } else {
                        toastr.error("Error removing file.");
                    }
                });

                $('#confirm_delete_modal').modal('hide');
            });
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

<script>
    $('#alumno').on('click',function(){
        $('#modal_alumno').modal({show:true});
    });
    $('#guardar_alumno').on('click',function(){
        $('#modal_alumno').modal('hide');
    });
   </script>

 <script>
    $('#boton_elegir_alumno').on('click',function(){
      $('#modal_alumno_elegir').modal({show:true});
                });
 </script> 


<script>
    // Escuchar el evento personalizado alumnoAgregado y actualizar el datatable
    Livewire.on('alumnoAgregado', function() {
        // Código para actualizar el datatable con los datos más recientes
        // Por ejemplo:
        actualizarDatos();
       // window.livewire.find('tablaAlumnos').call('actualizarDatos');
    });
</script>

<script>
    function actualizarDatos() {
        var table = $('#AlumnosTable').DataTable();

        // Destruir la tabla existente
        table.destroy();

        $('#AlumnosTable').dataTable( {
             "serverSide": true,
             "ajax":"{{url('/Alumnos_elegir')}}",                
             "columns":[
                     {data: 'id', name: 'alumnos.id', width: '50px'},
                     {data: 'nombre', name: 'alumnos.nombre', width: '205px'},
                     {data: 'direccion', name: 'alumnos.direccion', width: '30px'},
                     {data: 'mail', name: 'alumnos.mail', width: '205px'},
                     {data: 'telefono', name: 'alumnos.telefono', width: '205px'},
                     {data: 'seleccionar', name: 'seleccionar', width: '150px'},
                                              
                      ]           
        } );
    } ;

 </script>





<script>
    $(document).ready(function() {
        $('#AlumnosTable').dataTable( {
             "serverSide": true,
             "ajax":"{{url('/Alumnos_elegir')}}",                
             "columns":[
                     {data: 'id', name: 'alumnos.id', width: '50px'},
                     {data: 'nombre', name: 'alumnos.nombre', width: '205px'},
                     {data: 'direccion', name: 'alumnos.direccion', width: '30px'},
                     {data: 'mail', name: 'alumnos.mail', width: '205px'},
                     {data: 'telefono', name: 'alumnos.telefono', width: '205px'},
                     {data: 'seleccionar', name: 'seleccionar', width: '150px'},
                                              
                      ]           
        } );
    } );

 </script>


     <script>
        function selecciona_alumno(id,nombre) {     
        
         $('#id_alumno').val(id);
         $('#alumno_elegido').val(nombre);
         $('#modal_alumno_elegir').modal('hide');

         }
     </script>

     
    <script>
     function actualizarPrecio() {
            var select = document.getElementById("id_curso");
            var precio = select.options[select.selectedIndex].getAttribute("data-precio");
            document.getElementsByName("precio")[0].value =precio ;
    
        }
     </script>

@stop
