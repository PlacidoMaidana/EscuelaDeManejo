@extends('layouts.voyager2')

@section('page_title', __('voyager::generic.view') . ' ' . 'Calendario de clases'))

@push('css')
    <link href="https://cdn.isdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">

    <style>
        .card {
            background-color: #BEEAE3;
        }
    </style>
@endpush

@section('page_header')
    <h1 class="page-title"> Camara</h1>
@stop

@section('content')
    <div class="page-content read container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"> </div>
                    <div class="card-body">
                        <h1>Formulario con imágenes</h1>
                        <!-- Formulario para enviar la imagen -->
                        <form action="" id="formFoto"  method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="alumnoId" class="form-label">Debe ingresar su ID de alumno</label>
                                <input type="text" class="form-control" id="alumnoId" name="alumnoId" placeholder="Ingrese su ID de alumno" required >
                            </div>
                            <div id="alumnoData" style="display: none;">
                                <p><strong>Nombre:</strong> <span id="nombre"></span></p>
                                <p><strong>Dirección:</strong> <span id="direccion"></span></p>
                                <p><strong>Correo Electrónico:</strong> <span id="correo"></span></p>
                                <p><strong>Teléfono:</strong> <span id="telefono"></span></p>
                                <!-- Agrega más campos según sea necesario -->
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card">

                                        <video id="video" width="640" height="480" autoplay></video>

                                        <!-- Agregar un campo oculto para enviar los datos base64 de la imagen -->
                                        <input type="hidden" id="capturedImageDataInput" name="capturedImageDataInput">
                                        <canvas id="canvas" width="640" height="480" style="display:none;"></canvas>


                                        <div class="card-body">
                                            <!-- Botón para guardar la imagen original -->
                                            <button type="button" id="captureButton" class="btn btn-primary">
                                                Tomar foto
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <!-- Elemento img para mostrar la imagen capturada -->
                                        <img src="{{ asset('storage/img/nofoto.jpg') }}" id="capturedImage" width="640"
                                            height="480" src="" alt="Captured Image">

                                    </div>
                                </div>
                            </div>

                            <div class="mt-3">
                                <!-- Agregar un botón para enviar el formulario -->
                                <button type="submit" class="btn btn-primary" id="submitButton">Guardar fotos</button>

                            </div>


                        </form>




                    </div>

                </div>
            </div>
        </div>

    @stop



    @section('javascript')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
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

        <script>
            // Función para actualizar la acción del formulario con el ID del alumno
            function updateFormAction(id) {
                var actionUrl = "{{ route('guardar.foto.alumno.registro', ['id' => ':id']) }}";
                actionUrl = actionUrl.replace(':id', id);

                console.log(actionUrl);
                document.getElementById('formFoto').action = actionUrl;
            }
           

         
        </script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const alumnoIdInput = document.getElementById('alumnoId');
        const alumnoDataDiv = document.getElementById('alumnoData');
        const nombreSpan = document.getElementById('nombre');
        const direccionSpan = document.getElementById('direccion');
        const correoSpan = document.getElementById('correo');
        const telefonoSpan = document.getElementById('telefono');
    
        alumnoIdInput.addEventListener('blur', function() {
            const alumnoId = alumnoIdInput.value;
            
            if (alumnoId) {
                axios.get("{{url('/get-alumno/')}}/"+alumnoId)
                    .then(response => {
                        const alumno = response.data;
                        console.log(alumno);
                        updateFormAction(alumno.id);
                        nombreSpan.textContent = alumno.nombre;
                        direccionSpan.textContent = alumno.direccion;
                        correoSpan.textContent = alumno.mail;
                        telefonoSpan.textContent = alumno.telefono;
                        alumnoDataDiv.style.display = 'block';
                    })
                    .catch(error => {
                        console.error(error);
                        alert('Alumno no encontrado');
                        alumnoDataDiv.style.display = 'none';
                    });
            }
        });
    });
    </script>



    @stop
