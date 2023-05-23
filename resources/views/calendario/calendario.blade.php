@extends('voyager::master')

@section('page_title', __('voyager::generic.view').' '.'Calendario de clases'))

@push('css')
<link href="https://cdn.isdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet" >  

@endpush

@section('page_header')
    <h1 class="page-title"> Calendario</h1>
    
@stop

@section('content')
    <div class="page-content read container-fluid">
        <div class="row">
            <div class="col-md-12">
             
              <div class="card">

                <div class="card-header">{{ __('Dashboard') }} </div>
                <div class="card-body">
                    <div id='calendar'></div>
                </div>
              </div>

            </div>
        </div>
    </div>


    {{-- //|##############################################|
         //|       Modal Calendario                       |
         //|##############################################| --}}

         <!-- Button trigger modal -->
         <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#ModCalendario">
           Launch
         </button>
         
         <!-- Modal -->
         <div class="modal fade" id="ModCalendario" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body">
                         

                       <form action="" id="FormCalendar" method="post">
                        {!! csrf_field() !!}
                       

                        <div class="form-group">
                          <label for="clase"> Descripcion Clase </label>
                          <input type="text" class="form-control" name="clase" id="clase" 
                          aria-describedby="helpId" placeholder="" value=" {{ $numero_clases[1]->nombre." ".($numero_clases[1]->cantidad_eventos +1) }}">
                        </div>

                        <!-- El select de franjas horarias  -->
                        <div class="form-group">
                          <label for="id">Franjas horarias</label>
                          <select name="franja_horaria" id="franja_horaria_select">
                            @foreach ($franjasHorarias as $franjaHoraria)
                                <option value="{{ $franjaHoraria->id }}">{{ $franjaHoraria->descripcion }}</option>
                            @endforeach
                        </select>
                        </div>

                       

                        <div class="form-group">
                          <label for="start_date">fecha inicio</label>
                          <input type="text" class="form-control" name="start_date" id="start_date" aria-describedby="helpId" placeholder="" value="">
                        </div>

                        <div class="form-group">
                            <label for="end_date"> fecha fin</label>
                            <input type="text" class="form-control" name="end_date" id="end_date" aria-describedby="helpId" placeholder="">
                        </div>

                        <div class="form-group">
                          <label for="idAlumnoCurso">id alumno curso</label>
                          <input type="text" class="form-control" name="idAlumnoCurso" id="idAlumnoCurso" aria-describedby="helpId" placeholder="" value="">
                        </div>

                        <div class="form-group">
                          <label for="idVehiculo">Vehiculo</label>
                          <input type="text" class="form-control" name="idVehiculo" id="idVehiculo" aria-describedby="helpId" placeholder="">
                        </div>

                        <div class="form-group">
                          <label for="idInstructor">idInstructor</label>
                          <input type="text" class="form-control" name="idInstructor" id="idInstructor" aria-describedby="helpId" placeholder="">
                        </div>

                        <div class="form-group">
                          <label for="asistencia">asistencia</label>
                          <input type="text" class="form-control" name="asistencia" id="asistencia" aria-describedby="helpId" placeholder="">
                        </div>

                        <div class="form-group">
                          <label for="descripcion">descripcion</label>
                          <textarea class="form-control" name="descripcion" id="descripcion"
                           cols="30" rows="10" aria-describedby="helpId"></textarea>
                        </div>

                       </form>



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" id="btn-guardar">Agregar</button>
                        <button type="button" class="btn btn-warning" id="btn-modificar">Modificar</button>
                        <button type="button" class="btn btn-danger" id="btn-eliminar">Eliminar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        
                    </div>
                </div>
            </div>
         </div>





 
@stop

@section('javascript')

<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.4/index.global.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


<script>

        document.addEventListener('DOMContentLoaded', function() {

        let formulario = document.getElementById("FormCalendar");
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',
          
            headerToolbar:{
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,listWeek'
            },

            dateClick:function(info){
                formulario.reset();
                formulario.start_date.value=info.dateStr;
                formulario.end_date.value=info.dateStr;
                formulario.idAlumnoCurso.value={{$AlumnoCursoInfo[0]->id}};
                
              
                 console.log(info);

                $('#ModCalendario').modal("show");
            },
            eventClick:function(info){
              var evento=info.event;
              console.log(evento);
             //  window.location.href = "http://127.0.0.1:8000/calendario/editar/"+info.event.id;

             axios.post("http://127.0.0.1:8000/calendario/editar/"+info.event.id)
              .then(
                (respuesta)=>{
                    formulario.id.value=respuesta.data.id;
                    formulario.clase.value=respuesta.data.clase;
                    formulario.start_date.value=respuesta.data.start_date;
                    formulario.end_date.value=respuesta.data.end_date;
                    formulario.idAlumnoCurso.value=respuesta.data.id_alumno_curso;
                    formulario.idVehiculo.value=respuesta.data.id_vehiculo;
                    formulario.idInstructor.value=respuesta.data.id_instructor;
                    formulario.asistencia.value=respuesta.data.asistencia;
                    formulario.descripcion.value=respuesta.data.descripcion;

                    $("#ModCalendario").modal("show");
                }
                )
              .catch((error) =>
                {
               console.log(error);
               // Manejar el error aquí, por ejemplo, mostrar un mensaje de error en la página
                });
            },
  
          events: @json($events) 
        // events: "http://127.0.0.1:8000/calendario/index" ,
        });
        

        calendar.setOption('locale','Es');
        calendar.render();
       
        document.getElementById("btn-guardar").addEventListener("click",function(){
            const datos= new FormData(formulario);
            //console.log(datos.get('start_date'));
            // console.log(formulario.clase.value);
           
            axios.post("http://127.0.0.1:8000/calendario/agregar", datos)
            .then(
                (respuesta)=>{
                    console.log(respuesta);
                    //calendar.refetchEvents();
                    location.href = "http://127.0.0.1:8000/calendario/"+{{$idAlumnoCurso}};
                    $("#ModCalendario").modal("hide");
                }
            )
            .catch((error) => {
               console.log(error);
               // Manejar el error aquí, por ejemplo, mostrar un mensaje de error en la página
             });
        }); 
        
        document.getElementById("btn-eliminar").addEventListener("click",function(){
            const datos= new FormData(formulario);
            // console.log(datos.get('start_date'));
            // console.log(formulario.clase.value);
           
            axios.post("http://127.0.0.1:8000/calendario/borrar/"+formulario.id.value)
            .then(
                (respuesta)=>{
                    console.log(respuesta);
                    //calendar.refetchEvents();
                    location.href = "http://127.0.0.1:8000/calendario/"+{{$idAlumnoCurso}};
                    $("#ModCalendario").modal("hide");
                }
              )
            .catch((error) => {
               console.log(error);
               // Manejar el error aquí, por ejemplo, mostrar un mensaje de error en la página
             });

        }); 

        document.getElementById("btn-modificar").addEventListener("click",function(){
            const datos= new FormData(formulario);
            //console.log(datos.get('start_date'));
            //console.log(formulario.clase.value);
           
            axios.post("http://127.0.0.1:8000/calendario/actualizar/"+formulario.id.value , datos)
            .then(
                (respuesta)=>{
                    console.log(respuesta);
                   // calendar.refetchEvents();
                   location.href = "http://127.0.0.1:8000/calendario/"+{{$idAlumnoCurso}};
                    $("#ModCalendario").modal("hide");
                }
              )
            .catch((error) => {
               console.log(error);
               // Manejar el error aquí, por ejemplo, mostrar un mensaje de error en la página
             });

        }); 
      });
     

</script>

<script>
$(document).ready(function() {
  // Obtener referencia al select de franjas horarias
  var selectFranjaHoraria = $('#franja_horaria_select');

  // Escuchar el evento 'change' del select de franjas horarias
  selectFranjaHoraria.on('change', function() {
  var franjaHorariaSeleccionada = selectFranjaHoraria.val();

  
// Realizar la solicitud AJAX para obtener los valores de start_date y end_date
   
    $.ajax({
      url: '/calendario/obtener_fechas/' + franjaHorariaSeleccionada,
      method: 'GET',
      success: function(response) {
        // Actualizar los campos de fecha en el formulario del evento
        
        $('#start_date').val(response.start_date);
        $('#end_date').val(response.end_date);
      },
      error: function(jqXHR, textStatus, errorThrown) {
        // Manejar el error de la solicitud AJAX
        console.log('Error:', errorThrown);
        
      }
    });
  });
});


</script>



@stop
