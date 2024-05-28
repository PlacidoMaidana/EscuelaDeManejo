@extends('voyager::master')

@section('page_title', __('voyager::generic.view') . ' ' . 'Calendario de clases'))

@push('css')
    <link href="https://cdn.isdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
@endpush

@section('page_header')
    <h1 class="page-title"> Camara</h1>
@stop

@section('content')
    <div class="page-content read container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Esta es la pagina para el calendario </div>
                    <div class="card-body">
                        <!-- Formulario para enviar la imagen -->
                        <form action="{{ route('guardar.foto.alumno.registro', ['id' => $alumno->id]) }}"  method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $alumno->id }}">
                            <div class="row mb-3">
                                <div class="col-md-4"></div>
                                <div class="col-md-6">
                                    <h2>Foto</h2>
                                    <video id="video" width="100%" height="auto" autoplay></video>
                                    <!-- Botón para guardar la imagen original -->
                                    <button type="button" id="captureButton" class="btn btn-primary">
                                        {{ __('Capture Image') }}
                                    </button>
                                    <!-- Agregar un campo oculto para enviar los datos base64 de la imagen -->
                                    <input type="hidden" id="capturedImageDataInput" name="capturedImageDataInput">
                                    <canvas id="canvas" width="640" height="480" style="display:none;"></canvas>
                                </div>
                            </div>

                            <!-- Agregar un botón para enviar el formulario -->
                            <button type="submit" class="btn btn-primary" id="submitButton">Registrar foto</button>
                        </form>

                        <!-- Elemento img para mostrar la imagen capturada -->
                        <img id="capturedImage" src="" alt="Captured Image" style="display:none;" >

                    </div>

                </div>
            </div>
        </div>

    @stop

    @section('javascript')

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
