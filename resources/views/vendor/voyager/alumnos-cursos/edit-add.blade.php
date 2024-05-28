@php
    use App\Sucursale;
    $edit = !is_null($dataTypeContent->getKey());
    $add = is_null($dataTypeContent->getKey());
@endphp

@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @livewireStyles
@stop

@section('page_title', __('voyager::generic.' . ($edit ? 'edit' : 'add')) . ' ' .
    $dataType->getTranslatedAttribute('display_name_singular'))

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
                Sucursal: {{ $nombre_sucursal[0]->sucursal }} <br>
                <div class="panel panel-bordered">
                    <!-- form start -->
                    <form role="form" id="form_alumno" class="form-edit-add"
                        action="{{ $edit ? route('voyager.' . $dataType->slug . '.update', $dataTypeContent->getKey()) : route('voyager.' . $dataType->slug . '.store') }}"
                        method="POST" enctype="multipart/form-data">
                        <!-- PUT Method if we are editing -->
                        @if ($edit)
                            {{ method_field('PUT') }}
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
                                $dataTypeRows = $dataType->{$edit ? 'editRows' : 'addRows'};

                            @endphp

                            @for ($i = 0; $i < count($dataTypeRows); $i++)
                                <!-- GET THE DISPLAY OPTIONS -->
                                @php
                                    $row = $dataTypeRows[$i];
                                    $display_options = $row->details->display ?? null;
                                    if ($dataTypeContent->{$row->field . '_' . ($edit ? 'edit' : 'add')}) {
                                        $dataTypeContent->{$row->field} =
                                            $dataTypeContent->{$row->field . '_' . ($edit ? 'edit' : 'add')};
                                    }
                                @endphp
                                @if (isset($row->details->legend) && isset($row->details->legend->text))
                                    <legend class="text-{{ $row->details->legend->align ?? 'center' }}"
                                        style="background-color: {{ $row->details->legend->bgcolor ?? '#f0f0f0' }};padding: 5px;">
                                        {{ $row->details->legend->text }}</legend>
                                @endif

                                @if ($row->getTranslatedAttribute('display_name') == 'cursos')
                                    <div class="form-group @if ($row->type == 'hidden') hidden @endif col-md-{{ $display_options->width ?? 12 }} {{ $errors->has($row->field) ? 'has-error' : '' }}"
                                        @if (isset($display_options->id)) {{ "id=$display_options->id" }} @endif>
                                        {{ $row->slugify }}
                                        <label class="control-label"
                                            for="name">{{ $row->getTranslatedAttribute('display_name') }}

                                        </label>
                                        @php
                                            foreach ($cursos as $curso) {
                                                if ($curso->id == $dataTypeContent->id_curso) {
                                                    $nombrecurso = $curso->nombre_curso;
                                                }
                                            }

                                        @endphp

                                        <select name="id_curso" class="form-control " id="id_curso"
                                            onchange="actualizarPrecio()">
                                            <option value="">Seleccionar curso</option>
                                            @if ($edit)
                                                <option selected value ="{{ $dataTypeContent->id_curso }}">
                                                    {{ $nombrecurso }} </option>
                                            @endif

                                            @foreach ($cursos as $curso)
                                                <option value="{{ $curso->id }}"
                                                    data-precio="{{ $curso->precio_curso }}">{{ $curso->nombre_curso }}
                                                </option>
                                            @endforeach
                                        </select>

                                    </div>

                                    @php
                                        continue;
                                    @endphp
                                @endif


                                @if ($add)
                                    @if ($row->getTranslatedAttribute('display_name') == 'sucursales')
                                        <input type="hidden" name="id_sucursal" value="{{ $sucursal }}">
                                        @php
                                            continue;
                                        @endphp
                                    @endif
                                @endif

                                @if ($row->getTranslatedAttribute('display_name') == 'Comercial')
                                    <div class="form-group @if ($row->type == 'hidden') hidden @endif col-md-{{ $display_options->width ?? 12 }} {{ $errors->has($row->field) ? 'has-error' : '' }}"
                                        @if (isset($display_options->id)) {{ "id=$display_options->id" }} @endif>
                                        <label class="control-label"
                                            for="name">{{ $row->getTranslatedAttribute('display_name') }}

                                        </label>
                                        </br>
                                        @php
                                            $nombre_vendedor = '';
                                            foreach ($comerciales_activos as $comercial) {
                                                if ($comercial->id == $dataTypeContent->id_vendedor) {
                                                    $nombre_vendedor = $comercial->nombre;
                                                }
                                            }

                                        @endphp
                                        <select name="id_vendedor" id="id_vendedor">
                                            <option value="">Seleccione un comercial</option>
                                            @if ($edit)
                                                <option selected value ="{{ $dataTypeContent->id_vendedor }}">
                                                    {{ $nombre_vendedor }} </option>
                                            @endif

                                            @foreach ($comerciales_activos as $comercial)
                                                <option value="{{ $comercial->id }}">
                                                    {{ $comercial->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @php

                                        continue;
                                    @endphp
                                @endif



                                @if ($row->getTranslatedAttribute('display_name') == 'alumnos')
                                    {{-- <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
 <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<      Boton + Alumno          <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
 <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<                              <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
 <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< --}}
                                    <!-- Modal -->
                                    <div class="modal fade modal-warning" id="modal_alumno" v-if="allowCrop">
                                        <div class="modal-dialog" style="min-width: 50%">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-hidden="true">&times;</button>
                                                    <h4 class="modal-title">Nuevo alumno</h4>
                                                </div>
                                                <div id="x34" class="modal-body">
                                                    {{--  <livewire:ficha-alumno /> --}}



                                                    {{-- <<<<<<<<<<<<<<   EL FORMULARIO DE ALUMNO      >>>>>>>>>>>>>>>> --}}
                                                    <form method="POST" action="/guardar" id="form_alumno">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label for="my-input">Nombre</label>
                                                            <input class="form-control" type="text" id="nombre"
                                                                name="nombre">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="my-input">Direccion</label>
                                                            <input class="form-control" type="text" id="direccion"
                                                                name="direccion">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="my-input">Mail</label>
                                                            <input class="form-control" type="text" id="mail"
                                                                name="mail">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="my-input">Telefono</label>
                                                            <input class="form-control" type="text" id="telefono"
                                                                name="telefono">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="DNI">DNI</label>
                                                            <input class="form-control" type="text" id="DNI"
                                                                name="DNI">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="fecha_nacimiento">Fecha de nacimiento</label>
                                                            <input class="form-control" type="date" id="fecha_nacimiento"
                                                                name="fecha_nacimiento">
                                                        </div>




                                                        <div class="form-group">
                                                            <label for="localidad">Localidad</label>
                                                            <select class="form-control" id="localidad" name="localidad">
                                                                <option value="">Seleccionar localidad</option>
                                                                @foreach ($localidades as $localidad)
                                                                    <option value="{{ $localidad['id'] }}">
                                                                        {{ $localidad['localidad'] }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <input class="form-control" type="hidden" id="alumno_curso_id"
                                                            name="alumno_curso_id" value="2">
                                                        <button type="button"
                                                            id="guardar_alumno"class="btn btn-primary">Guardar </button>


                                                    </form>
                                                    {{-- ************************************      FIN FORMULARIO MODAL       **************************************
 ¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡
  --}}




                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" id="salir" class="btn btn-default"
                                                        data-dismiss="modal">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group @if ($row->type == 'hidden') hidden @endif col-md-{{ $display_options->width ?? 12 }} {{ $errors->has($row->field) ? 'has-error' : '' }}"
                                        @if (isset($display_options->id)) {{ "id=$display_options->id" }} @endif>
                                        {{ $row->slugify }}
                                        <label class="control-label"
                                            for="name">{{ $row->getTranslatedAttribute('display_name') }}
                                            <!-- Button trigger modal -->
                                            <button type="button" id="alumno" class="btn btn-primary"
                                                data-bs-toggle="modal" data-bs-target="#modal_alumno">
                                                + Alumno
                                            </button>
                                        </label>

                                        <button type="button" id="boton_elegir_alumno" class="btn btn-primary"
                                            data-bs-toggle="modal" data-bs-target="#modal_alumno_elegir">
                                            Buscar Alumno
                                        </button>

                                        <input type="hidden" id="id_alumno" name="id_alumno"
                                            value="{{ session('id_alumno') }}">


                                        <input type="text" id="alumno_elegido" name="alumno_elegido" required readonly
                                            value="{{ session('nombre_alumno') }}" style="WIDTH: 550px">

                                        <!-- <a href="#" id="registrar_foto" class="btn btn-primary">Registrar Foto</a> -->

                                        <button type="button" id="boton_foto" class="btn btn-primary"
                                            data-bs-toggle="modal" data-bs-target="#modal_foto">
                                            Registrar foto
                                        </button>


                                    </div>

                                    @php
                                        continue;
                                    @endphp
                                @endif

                                {{--  >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  --}}
                                {{-- >>>>>>>>>>>>>>>>>>>>>>   ALUMNOS   >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  --}}
                                {{-- >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  --}}

                                <div class="modal fade modal-warning" id="modal_alumno_elegir" v-if="allowCrop">
                                    <div class="modal-dialog" style="min-width: 90%">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">&times;</button>
                                                <h4 class="modal-title">Seleccione un Alumno</h4>
                                            </div>

                                            <div id="x34" class="modal-body">
                                                <div class="card" style="min-width: 70%">
                                                    <img class="card-img-top" src="holder.js/100x180/" alt="">
                                                    <div class="card-body">
                                                        <h4 class="card-title">Elegir Alumnos</h4>
                                                        <table id="AlumnosTable"
                                                            class="table table-striped table-bordered dt-responsive nowrap"
                                                            style="width:60%">
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
                                                <button type="button" id="salir" class="btn btn-default"
                                                    data-dismiss="modal">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- <<<<<<<<<<<<<<<<<<<<<<<    FIN MODAL ALUMNOS    >>>>>>>>>>>>>>>>>>>>>>>>>>>> --}}
                                {{-- >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  --}}
                                {{-- >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  --}}

                                <div class="form-group @if ($row->type == 'hidden') hidden @endif col-md-{{ $display_options->width ?? 12 }} {{ $errors->has($row->field) ? 'has-error' : '' }}"
                                    @if (isset($display_options->id)) {{ "id=$display_options->id" }} @endif>
                                    {{ $row->slugify }}
                                    <label class="control-label"
                                        for="name">{{ $row->getTranslatedAttribute('display_name') }}</label>
                                    @include('voyager::multilingual.input-hidden-bread-edit-add')
                                    @if (isset($row->details->view))
                                        @include($row->details->view, [
                                            'row' => $row,
                                            'dataType' => $dataType,
                                            'dataTypeContent' => $dataTypeContent,
                                            'content' => $dataTypeContent->{$row->field},
                                            'action' => $edit ? 'edit' : 'add',
                                            'view' => $edit ? 'edit' : 'add',
                                            'options' => $row->details,
                                        ])
                                    @elseif ($row->type == 'relationship')
                                        @include('voyager::formfields.relationship', [
                                            'options' => $row->details,
                                        ])
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

                            <button id="guardar_alumno_evento" type="submit"
                                class="btn btn-primary save">{{ __('voyager::generic.save') }}</button>
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

{{--  >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  --}}
{{-- >>>>>>>>>>>>>>>>>>>>>>   MODAL FOTO   >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  --}}
{{-- >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  --}}

<div class="modal fade modal-warning" id="modal_foto" v-if="allowCrop">
    <div class="modal-dialog" style="min-width: 90%">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">FOTO</h4>
            </div>

            <div id="x34" class="modal-body">
                <div class="card" style="min-width: 70%">
                    <img class="card-img-top" src="holder.js/100x180/" alt="">
                    <div class="card-body">
                        <h4 class="card-title">FOTO</h4>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">Foto de registro </div>
                                    <div class="card-body">
                                        <!-- Formulario para enviar la imagen -->

                                        <form action=" " method="POST" id="formFoto" name="formFoto">
                                            @csrf
                                            <input type="hidden" name="id_alumno_foto" value="">
                                            <input type="hidden" id="nombre_alumno" name="nombre_alumno">
                                            <div class="row mb-3">
                                                <div class="col-md-4"></div>
                                                <div class="col-md-6">
                                                    <h2>Foto</h2>
                                                    <video id="video" width="100%" height="auto"
                                                        autoplay></video>
                                                    <!-- Botón para guardar la imagen original -->
                                                    <button type="button" id="captureButton"
                                                        class="btn btn-primary">
                                                        {{ __('Capture Image') }}
                                                    </button>
                                                    <!-- Agregar un campo oculto para enviar los datos base64 de la imagen -->
                                                    <input type="hidden" id="capturedImageDataInput"
                                                        name="capturedImageDataInput">
                                                    <canvas id="canvas" width="640" height="480"
                                                        style="display:none;"></canvas>
                                                </div>
                                            </div>

                                            <!-- Agregar un botón para enviar el formulario -->
                                            <button type="button" class="btn btn-primary"
                                                id="submitButton">Registrar foto</button>
                                        </form>

                                        <!-- Elemento img para mostrar la imagen capturada -->
                                        <img id="capturedImage" src="" alt="Captured Image"
                                            style="display:none;">

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" id="salir" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

{{-- <<<<<<<<<<<<<<<<<<<<<<<    FIN MODAL FOTO    >>>>>>>>>>>>>>>>>>>>>>>>>>>> --}}
{{-- >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  --}}
{{-- >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  --}}









<div class="modal fade modal-danger" id="confirm_delete_modal">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="voyager-warning"></i> {{ __('voyager::generic.are_you_sure') }}
                </h4>
            </div>

            <div class="modal-body">
                <h4>{{ __('voyager::generic.are_you_sure_delete') }} '<span class="confirm_delete_name"></span>'</h4>
            </div>


            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                    data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
                <button type="button" class="btn btn-danger"
                    id="confirm_delete">{{ __('voyager::generic.delete_confirm') }}</button>
            </div>
        </div>
    </div>
</div>
<!-- End Delete File Modal -->
@livewireScripts
@stop

@section('javascript')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    var params = {};
    var $file;

    function deleteHandler(tag, isMulti) {
        return function() {
            $file = $(this).siblings(tag);

            params = {
                slug: '{{ $dataType->slug }}',
                filename: $file.data('file-name'),
                id: $file.data('id'),
                field: $file.parent().data('field-name'),
                multi: isMulti,
                _token: '{{ csrf_token() }}'
            }

            $('.confirm_delete_name').text(params.filename);
            $('#confirm_delete_modal').modal('show');
        };
    }

    $('document').ready(function() {
        $('.toggleswitch').bootstrapToggle();

        //Init datepicker for date fields if data-datepicker attribute defined
        //or if browser does not handle date inputs
        $('.form-group input[type=date]').each(function(idx, elt) {
            if (elt.hasAttribute('data-datepicker')) {
                elt.type = 'text';
                $(elt).datetimepicker($(elt).data('datepicker'));
            } else if (elt.type != 'date') {
                elt.type = 'text';
                $(elt).datetimepicker({
                    format: 'L',
                    extraFormats: ['YYYY-MM-DD']
                }).datetimepicker($(elt).data('datepicker'));
            }
        });

        @if ($isModelTranslatable)
            $('.side-body').multilingual({
                "editing": true
            });
        @endif

        $('.side-body input[data-slug-origin]').each(function(i, el) {
            $(el).slugify();
        });

        $('.form-group').on('click', '.remove-multi-image', deleteHandler('img', true));
        $('.form-group').on('click', '.remove-single-image', deleteHandler('img', false));
        $('.form-group').on('click', '.remove-multi-file', deleteHandler('a', true));
        $('.form-group').on('click', '.remove-single-file', deleteHandler('a', false));

        $('#confirm_delete').on('click', function() {
            $.post('{{ route('voyager.' . $dataType->slug . '.media.remove') }}', params, function(
                response) {
                if (response &&
                    response.data &&
                    response.data.status &&
                    response.data.status == 200) {

                    toastr.success(response.data.message);
                    $file.parent().fadeOut(300, function() {
                        $(this).remove();
                    })
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
    // Escuchar el evento personalizado alumnoAgregado y actualizar el datatable
    Livewire.on('alumnoAgregado', function() {
        // Código para actualizar el datatable con los datos más recientes
        // Por ejemplo:
        actualizarDatos();
        // window.livewire.find('tablaAlumnos').call('actualizarDatos');
    });
</script>


<script>
    $('#boton_elegir_alumno').on('click', function() {
        $('#modal_alumno_elegir').modal({
            show: true
        });
    });
</script>

<script>
    $('#boton_foto').on('click', function() {
        $('#modal_foto').modal({
            show: true
        });
    });
</script>

<script>
    function actualizarDatos() {
        var table = $('#AlumnosTable').DataTable();

        // Destruir la tabla existente
        table.destroy();

        $('#AlumnosTable').dataTable({
            "serverSide": true,
            "ajax": "{{ url('/Alumnos_elegir') }}",
            "columns": [{
                    data: 'id',
                    name: 'alumnos.id',
                    width: '50px'
                },
                {
                    data: 'nombre',
                    name: 'alumnos.nombre',
                    width: '205px'
                },
                {
                    data: 'direccion',
                    name: 'alumnos.direccion',
                    width: '30px'
                },
                {
                    data: 'mail',
                    name: 'alumnos.mail',
                    width: '205px'
                },
                {
                    data: 'telefono',
                    name: 'alumnos.telefono',
                    width: '205px'
                },
                {
                    data: 'seleccionar',
                    name: 'seleccionar',
                    width: '150px'
                },

            ]
        });
    };
</script>

<script>
    $(document).ready(function() {
        $('#AlumnosTable').dataTable({
            "serverSide": true,
            "ajax": "{{ url('/Alumnos_elegir') }}",
            "columns": [{
                    data: 'id',
                    name: 'alumnos.id',
                    width: '50px'
                },
                {
                    data: 'nombre',
                    name: 'alumnos.nombre',
                    width: '205px'
                },
                {
                    data: 'direccion',
                    name: 'alumnos.direccion',
                    width: '30px'
                },
                {
                    data: 'mail',
                    name: 'alumnos.mail',
                    width: '205px'
                },
                {
                    data: 'telefono',
                    name: 'alumnos.telefono',
                    width: '205px'
                },
                {
                    data: 'seleccionar',
                    name: 'seleccionar',
                    width: '150px'
                },

            ]
        });
    });
</script>



<script>
    //Una vez usada la variable de sesion que mantiene el alumno quiero que la olvide
    $(document).ready(function() {
        // Olvidar la variable de sesión 'nombre_alumno'
        @if (session()->has('nombre_alumno'))
            @php
                session()->forget('nombre_alumno');
                session()->forget('id_alumno');
            @endphp
        @endif
    });
</script>

<script>
    // Función para actualizar la acción del formulario con el ID del alumno
    function updateFormAction(id) {
        var actionUrl = "{{ route('guardar.foto.alumno.registro', ['id' => ':id']) }}";
        actionUrl = actionUrl.replace(':id', id);

        console.log(actionUrl);
        document.getElementById('formFoto').action = actionUrl;
    }


    function selecciona_alumno(id, nombre) {

        $('#id_alumno').val(id);
        $('#alumno_elegido').val(nombre);
        $('#modal_alumno_elegir').modal('hide');

        // Asignar el nombre del alumno al campo oculto
        document.getElementById('nombre_alumno').value = nombre;


        // Construir la URL del botón "Registrar Foto" dinámicamente en el lado del cliente
        var registrarFotoUrl = '/cargar-foto-alumno/' + id;
        $('#registrar_foto').attr('href', registrarFotoUrl);

        // Asigna el id del alumno al campo oculto del formulario
        document.getElementById('id_alumno_foto').value = id;

        // Construir la URL del action del formulario dinámicamente

        updateFormAction(id);

    }

    // Controlador de evento de clic para el botón de envío
    document.getElementById('submitButton').addEventListener('click', function() {
        // Obtener el ID del alumno
        var idAlumno = document.getElementById('id_alumno').value;
        // Actualizar la acción del formulario
        updateFormAction(idAlumno);

        // Enviar el formulario
        document.getElementById('formFoto').submit();
        $('#modal_foto').modal('hide');
    });
</script>


<script>
    function actualizarPrecio() {
        var select = document.getElementById("id_curso");
        var precio = select.options[select.selectedIndex].getAttribute("data-precio");
        document.getElementsByName("precio")[0].value = precio;

    }
</script>



<script>
    //+-----------------------------------------------------------------------------------------------------
    //+-----------------------------------------------------------------------------------------------------
    //+                             Nuevo alumno usando AXIOS
    //+
    //+=====================================================================================================
    //+=====================================================================================================

    document.addEventListener('DOMContentLoaded', function() {
        var modal = document.getElementById('modal_alumno');

        // Obtener el botón que abre el modal
        var btnAbrirModal = document.getElementById('alumno');

        // Escuchar el evento clic en el botón que abre el modal
        btnAbrirModal.addEventListener('click', function() {
            // Mostrar el modal utilizando el método "show" del modal de Bootstrap
            $('#modal_alumno').modal({
                show: true
            });
        });

        // Escuchar el evento clic en el botón "Guardar"
        $('#guardar_alumno').on('click', function() {

            // Obtener los valores de los campos utilizando jQuery
            var nombre = $('#nombre').val();
            var direccion = $('#direccion').val();
            var mail = $('#mail').val();
            var telefono = $('#telefono').val();
            var localidad = $('#localidad').val();
            var DNI = $('#DNI').val();
            var fecha_nacimiento = $('#fecha_nacimiento').val();

            // Crear un objeto FormData y agregar los valores obtenidos
            var formData = new FormData();
            formData.append('nombre', nombre);
            formData.append('direccion', direccion);
            formData.append('mail', mail);
            formData.append('telefono', telefono);
            formData.append('localidad', localidad);
            formData.append('DNI', DNI);
            formData.append('fecha_nacimiento', fecha_nacimiento);

            // Mostrar los valores del formulario en la consola
            console.log("El formulario que enviaremos:");
            for (const [key, value] of formData.entries()) {
                console.log(key, value);
            }

            // Obtener los datos del formulario utilizando jQuery
            //var formData = $('#form_alumno').serialize();

            // Enviar los datos por Axios
            //Debido a la configuración del servidor virtual de la escuela de manejo, es importante agregar "index.php" a las rutas al realizar solicitudes por Axios.
            axios.post('/alta_alumno', formData)
                .then(function(response) {
                    // Manejar la respuesta del servidor
                    for (var key in response.data) {
                        console.log(key + ": " + response.data[key]);
                    }
                    console.log(response.data);
                    //debugger;
                    // Cerrar el modal después de enviar los datos
                    $('#modal_alumno').modal('hide');
                })
                .catch(function(error) {
                    // Manejar errores de la solicitud
                    console.error(error);
                });
        });
    });
    //+=====================================================================================================
    //+=====================================================================================================
</script>

<script>
    $(document).ready(function() {
        $('#guardar_alumno_evento').on('click', function() {
            //alert('Clic en el botón de submit'); // Verifica si se muestra el alert
            $('#form_alumno').submit(); // Intenta ejecutar el submit
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', async () => {
        const video = document.getElementById('video');
        const canvas = document.getElementById('canvas');
        const captureButton = document.getElementById('captureButton');
        const photo = document.getElementById('capturedImage');
        const capturedImageDataInput = document.getElementById('capturedImageDataInput');
        const submitButton = document.getElementById('submitButton');
        let width = 640; // Update with your desired width
        let height = 480; // Update with your desired height

        async function initCamera() {
            try {
                const stream = await navigator.mediaDevices.getUserMedia({
                    video: true
                });
                video.srcObject = stream;
            } catch (err) {}
        }

        await initCamera();

        captureButton.addEventListener('click', () => {
            takepicture();
        });

        function takepicture() {
            const context = canvas.getContext("2d");
            if (width && height) {
                canvas.width = width;
                canvas.height = height;
                context.drawImage(video, 0, 0, width, height);

                const data = canvas.toDataURL("image/png");
                photo.setAttribute("src", data);

                // Envía los datos base64 al campo oculto en el formulario
                capturedImageDataInput.value = data;

                // capturedImage.style.display = 'block';


            } else {
                console.error('Ancho o alto no definido.');
            }
        }

    });
</script>

@stop
