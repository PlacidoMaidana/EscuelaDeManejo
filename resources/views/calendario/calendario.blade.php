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

                <div class="card-header"> 
               {{--
                   <select name="id_vehiculo" class="col-md-4" id="id_vehiculo" >
                    <option selected>Seleccione vehiculo</option>               
                    @foreach ($vehiculos as $v)
                    <option value="{{ $v->id }}" >{{ $v->marca_modelo_anio }}</option>
                    @endforeach
                   </select>    

                   {{--<select name="id_horario" class="col-md-4 " id="id_horario" >
                    <option selected>Seleccione franja horaria</option>
                    @foreach ($franjasHorarias as $f)
                    <option value="{{ $f->id }}" >{{ $f->descripcion }}</option>
                    @endforeach
                   </select>  --}}  
                   <select name="instructores" id="filtrar_por_instructor">
                    <option selected>Seleccione el instructor</option>
                    @foreach ($instructores as $instructor)
                        <option value="{{ $instructor->id }}">{{ $instructor->nombre }}</option>
                    @endforeach
                   </select>

                
                </div>
                <div class="card-body">
                    <div id='calendar'></div>
                </div>
              </div>

            </div>
        </div>
    </div>


    {{-- 
 /<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>><<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>><<<<<<<<<><<>>>>>>>>>>>>>>>>
//+-----------------------------------------------------------------------------------------------------
//+                   Modal calendario
//+===================================================================================================== 
        --}}
         
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
                       
                        <input type="hidden" name="id" value="">
                        <div class="form-group">
                          <label for="clase"> Alumno </label>
                          <input type="text" class="form-control" name="alumno" id="alumno" 
                          aria-describedby="helpId" placeholder="" value=" {{ $AlumnoCursoInfo[0]->nombre }}">
                        </div>
 
                        <div class="form-group">
                          <label for="clase"> Descripcion Clase </label>
                          <input type="text" class="form-control" name="clase" id="clase" 
                          aria-describedby="helpId" placeholder="" value="" >
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

                          <!-- El select de franjas horarias  -->
                          <div class="form-group">
                            <label for="id">Tipos Eventos</label>
                            <select name="tipos_eventos" id="tipos_eventos_select">
                              @foreach ($tipos_eventos as $tipo)
                                  <option value="{{ $tipo->id }}">{{ $tipo->tipo_evento }}</option>
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
                        <input type="hidden"  name="idAlumnoCurso" id="idAlumnoCurso" aria-describedby="helpId" placeholder="" value="">
                       
                        <div class="form-group">
                          <label for="id">Vehiculo</label>
                          <select name="vehiculos" id="vehiculos_select">
                            @foreach ($vehiculos as $vehiculo)
                                <option value="{{ $vehiculo->id }}">{{ $vehiculo->marca_modelo_anio }}</option>
                            @endforeach
                        </select>
                        </div>

                        <div class="form-group">
                          <label for="id">Instructor</label>
                          <select name="instructores" id="instructores_select">
                            @foreach ($instructores as $instructor)
                                <option value="{{ $instructor->id }}">{{ $instructor->nombre }}</option>
                            @endforeach
                        </select>
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

//+-----------------------------------------------------------------------------------------------------
//+-----------------------------------------------------------------------------------------------------
//+                             Carga el calendario al inicio
//+
//+=====================================================================================================
//+=====================================================================================================

          const idInstructorSelect = document.getElementById('filtrar_por_instructor');
          //const idVehiculoSelect = document.getElementById('id_vehiculo');
          //const idHorarioSelect = document.getElementById('id_horario');
          const idInstructor = idInstructorSelect.value;
          //const idVehiculo = idVehiculoSelect.value;
          //const idHorario = idHorarioSelect.value;

          //const ruta = "{{url('/obtener-eventos/')}}/" + idVehiculo + "/" + idHorario; 
          //const ruta = "{{url('/obtener-eventos/')}}/" + idVehiculo; 
          const ruta = "{{url('/obtener-eventos-por-instructor/')}}/" + idInstructor; 
         console.log("la ruta al inicio");
         console.log(ruta);
        let formulario = document.getElementById("FormCalendar");
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'timeGridWeek',
          slotMinTime: "07:00:00",
          slotMaxTime: "21:00:00",
          height: 'auto',
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

              var dateStr = $('#start_date');
              var dateEND = $('#end_date');
              var instructor = $('#instructores_select');
              var instructor_seleccionado = $('#filtrar_por_instructor');
              instructor.val(instructor_seleccionado.val());
              var Clase = $('#clase');
              var Alumno = $('#alumno');
              Clase.val(Alumno.val());

              // Convertir la cadena de fecha y hora en un objeto Date
              var fechaHoraEvento = new Date(info.dateStr);
              // Obtener la hora seleccionada en el calendario
              console.log("Solo la hora seleccionada:");
              var horaEvento = fechaHoraEvento.getHours() + ':' + fechaHoraEvento.getMinutes()+ ':' + fechaHoraEvento.getSeconds()+2; // Formato HH:mm
              console.log(horaEvento);

              console.log("Longitud de la tabla de franjas horarias");
              var franjasHorarias = {!! json_encode($franjasHorarias) !!};

              // Obtener el select de franjas horarias y su valor seleccionado
              var selectFranjaHoraria = document.getElementById('franja_horaria_select');
              var franjaHorariaSeleccionada = selectFranjaHoraria.value;
              // Recorrer las franjas horarias y seleccionar automáticamente la coincidente
               for (var i = 0; i < franjasHorarias.length; i++) {
                console.log("El valor de i:"+i);
                console.log("Estart time:"+ franjasHorarias[i].start_time);
                console.log("EndTime :"+ franjasHorarias[i].end_time);
                console.log("horaEvento:"+ horaEvento);
                 if (franjasHorarias[i].start_time <= horaEvento && franjasHorarias[i].end_time > horaEvento) {
                   selectFranjaHoraria.value = franjasHorarias[i].id;
                   console.log("entro al if");
                   // Realizar la solicitud AJAX para obtener los valores de start_date y end_date
                
                             $.ajax({
                               url: '/index.php/calendario/obtener_fechas/' + franjasHorarias[i].id +'/'+dateStr.val(),
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
                           
                   break; // Detener el bucle una vez que se encuentra una coincidencia
                 }
               }
             
              console.log(franjasHorarias);
             
              $('#ModCalendario').modal("show");
              },
            eventClick:function(info){
              var evento=info.event;
              console.log("la ruta es"+"{{url('/calendario/editar/')}}/" +info.event.id);
              console.log("Valores del evento:", evento);
             
             axios.get("{{url('/calendario/editar/')}}/" +info.event.id)
              .then(
                (respuesta)=>{
                  for (var key in respuesta.data) {
                       console.log(key + ": " + respuesta.data[key]);
                         }
                    
                    formulario.id.value=respuesta.data.id;
                    formulario.clase.value=respuesta.data.clase;
                    formulario.start_date.value=respuesta.data.start_date;
                    formulario.end_date.value=respuesta.data.end_date;
                    formulario.idAlumnoCurso.value=respuesta.data.id_alumno_curso;
                    formulario.vehiculos.value=respuesta.data.id_vehiculo;
                    formulario.instructores.value=respuesta.data.id_instructor;
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
  
                 
             events: ruta,
        });
        console.log("url de los eventos inicio:  "+ruta);
           
        calendar.setOption('locale','Es');
        calendar.render();
       
        document.getElementById("btn-guardar").addEventListener("click",function(){
            const datos= new FormData(formulario);
           /* console.log("Datos del formulario:");
              for (let pair of datos.entries()) {
                console.log(pair[0] + ': ' + pair[1]);
              }
            return;*/
            
            
            axios.post("{{url('/calendario/agregar')}}/", datos)
            .then(
                (respuesta)=>{
                  console.log("Luego de volver");
                  console.log(respuesta.data.request);
                  console.log(respuesta.data.clase);
                  console.log(datos);
                  calendar.refetchEvents();
                       //calendar.refetchEvents();
                            //location.href = "http://127.0.0.1:8000/calendario/"+{{$idAlumnoCurso}};
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
                    calendar.refetchEvents();
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

            console.log("Datos del formulario:");
              for (let pair of datos.entries()) {
                console.log(pair[0] + ': ' + pair[1]);
              }
            
           
            axios.post("http://127.0.0.1:8000/calendario/actualizar/"+formulario.id.value , datos)
             .then(
              (respuesta)=>{
                console.log("La respuesta es: ");
               console.log(respuesta);
              
              location.href = "http://127.0.0.1:8000/calendario/"+{{$idAlumnoCurso}};
               $("#ModCalendario").modal("hide");
               calendar.refetchEvents();
              }
              )
             .catch((error) => {
             console.log(error);
             // Manejar el error aquí, por ejemplo, mostrar un mensaje de error en la página
             });
            

             }); 
           

//+-----------------------------------------------------------------------------------------------------
//+-----------------------------------------------------------------------------------------------------
//+                   Carga el calendario al cambiar el instructor
//+
//+=====================================================================================================
//+=====================================================================================================
      
       // Obtener referencias a los elementos select
       //const idVehiculoSelect = document.getElementById('id_vehiculo');
      // document.getElementById('id_horario').addEventListener('change', function() {
document.getElementById('filtrar_por_instructor').addEventListener('change', function() {

    // Obtener referencias a los elementos select
      const idInstructorSelect = document.getElementById('filtrar_por_instructor');
    //const idVehiculoSelect = document.getElementById('id_vehiculo');
    //const idHorarioSelect = document.getElementById('id_horario');
    // Obtener valores seleccionados
     const idInstructor = idInstructorSelect.value;
     //const idVehiculo = idVehiculoSelect.value;
     //const idHorario = idHorarioSelect.value;
     // Verificar si se seleccionaron tanto el horario como el vehículo
     // if (idVehiculo && idHorario) {
     if (idInstructor) {
     // Generar la URL con los valores seleccionados
     //const url = "{{url('/obtener-eventos/')}}/" + idVehiculo + "/" + idHorario;
     const url = "{{url('/obtener-eventos-por-instructor/')}}/" + idInstructor;
     // Verificar si se obtuvo la instancia del calendario correctamente
     // Destruir el calendario existente
     console.log("url de los eventos: "+url);
     calendar.destroy();    
     // Inicializar nuevamente el calendario con la nueva fuente de eventos
      calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'timeGridWeek',
          slotMinTime: "07:00:00",
          slotMaxTime: "21:00:00",
          height: 'auto',
            headerToolbar:{
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,listWeek'
            },

//<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>><<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>><<<<<<<<<><<>>>>>>>>>>>>>>>>
//+-----------------------------------------------------------------------------------------------------
//+                   dateClick
//+=====================================================================================================

           
dateClick:function(info){               

            formulario.reset();
            formulario.start_date.value=info.dateStr;
            formulario.end_date.value=info.dateStr;
            formulario.idAlumnoCurso.value={{$AlumnoCursoInfo[0]->id}};

            var instructor = $('#instructores_select');
              var instructor_seleccionado = $('#filtrar_por_instructor');
              instructor.val(instructor_seleccionado.val());

            var dateStr = $('#start_date');
            var dateEND = $('#end_date');
            var Clase = $('#clase');
            var Alumno = $('#alumno');
            Clase.val(Alumno.val());

            // Convertir la cadena de fecha y hora en un objeto Date
            var fechaHoraEvento = new Date(info.dateStr);
            // Obtener la hora seleccionada en el calendario
            console.log("Solo la hora seleccionada:");
            var horaEvento = fechaHoraEvento.getHours() + ':' + fechaHoraEvento.getMinutes()+ ':' + fechaHoraEvento.getSeconds()+2; // Formato HH:mm
            console.log(horaEvento);

            console.log("Longitud de la tabla de franjas horarias");
            var franjasHorarias = {!! json_encode($franjasHorarias) !!};

            // Obtener el select de franjas horarias y su valor seleccionado
            var selectFranjaHoraria = document.getElementById('franja_horaria_select');
            var franjaHorariaSeleccionada = selectFranjaHoraria.value;
            // Recorrer las franjas horarias y seleccionar automáticamente la coincidente
             for (var i = 0; i < franjasHorarias.length; i++) {
              console.log("El valor de i:"+i);
              console.log("Estart time:"+ franjasHorarias[i].start_time);
              console.log("EndTime :"+ franjasHorarias[i].end_time);
              console.log("horaEvento:"+ horaEvento);
               if (franjasHorarias[i].start_time <= horaEvento && franjasHorarias[i].end_time > horaEvento) {
                 selectFranjaHoraria.value = franjasHorarias[i].id;
                 console.log("entro al if");
                 // Realizar la solicitud AJAX para obtener los valores de start_date y end_date
              
                           $.ajax({
                             url: '/index.php/calendario/obtener_fechas/' + franjasHorarias[i].id +'/'+dateStr.val(),
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
                         
                 break; // Detener el bucle una vez que se encuentra una coincidencia
               }
             }
           
            console.log(franjasHorarias);
           
            $('#ModCalendario').modal("show");
            },
//<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>><<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>><<<<<<<<<><<>>>>>>>>>>>>>>>>
//+-----------------------------------------------------------------------------------------------------
//+                   Event click
//+=====================================================================================================


            eventClick:function(info){
              var evento=info.event;
              console.log("la ruta es"+"{{url('/calendario/editar/')}}/" +info.event.id);
              console.log("Valores del evento:", evento);
             
             axios.get("{{url('/calendario/editar/')}}/" +info.event.id)
              .then(
                (respuesta)=>{
                  for (var key in respuesta.data) {
                       console.log(key + ": " + respuesta.data[key]);
                         }
                    
                    formulario.id.value=respuesta.data.id;
                    formulario.clase.value=respuesta.data.clase;
                    formulario.start_date.value=respuesta.data.start_date;
                    formulario.end_date.value=respuesta.data.end_date;
                    formulario.idAlumnoCurso.value=respuesta.data.id_alumno_curso;
                    formulario.vehiculos.value=respuesta.data.id_vehiculo;
                    formulario.instructores.value=respuesta.data.id_instructor;
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
  
        events: url,
        // Configuración adicional del calendario...
      });
    
      
     // Renderizar el calendario actualizado
     calendar.render();    
     }



    //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>


    
  });

 
      });

      
</script>

<script>
  $(document).ready(function() {
    // Obtener referencia al select de franjas horarias
    var selectFranjaHoraria = $('#franja_horaria_select');
    var date = $('#start_date');

    
    
    // Escuchar el evento 'change' del select de franjas horarias
    selectFranjaHoraria.on('change', function() {
    var franjaHorariaSeleccionada = selectFranjaHoraria.val();
    var diaDelEvento = date.val();
  
    var fechaEvento = encodeURIComponent(diaDelEvento); // Codificar la fecha antes de agregarla a la URL

    
  // Realizar la solicitud AJAX para obtener los valores de start_date y end_date
     
      $.ajax({
        url: '/index.php/calendario/obtener_fechas/' + franjaHorariaSeleccionada +'/'+fechaEvento,
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

<script>

  function actualizaFranjasHorarias() {
    
   
    // Obtener referencia al select de franjas horarias
    var selectFranjaHoraria = $('#franja_horaria_select');
   
    var date = $('#start_date');

    
    
    
    // Escuchar el evento 'change' del select de franjas horarias
    selectFranjaHoraria.on('change', function() {
    var franjaHorariaSeleccionada = selectFranjaHoraria.val();
    var diaDelEvento = date.val();
  
    var fechaEvento = encodeURIComponent(diaDelEvento); // Codificar la fecha antes de agregarla a la URL

    
  // Realizar la solicitud AJAX para obtener los valores de start_date y end_date
     
      $.ajax({
        url: '/index.php/calendario/obtener_fechas/' + franjaHorariaSeleccionada +'/'+fechaEvento,
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
 



  }
</script>

<script>
//<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>><<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>><<<<<<<<<><<>>>>>>>>>>>>>>>>
//+-----------------------------------------------------------------------------------------------------
//+ El objetivo de este escrip es estar atento a los cambios en movil y en franja horaria para traer 
//+ el instructor correspondiente
//+=====================================================================================================

document.addEventListener('DOMContentLoaded', function() {

  var horarios = {!! json_encode($horarios) !!};
  var vehiculoSelect = document.getElementById('vehiculos_select');
  var franjaHorariaSelect = document.getElementById('franja_horaria_select');
  var instructorSelect = document.getElementById('instructores_select');

  // Escuchar el evento 'change' en los select de vehículo y franja horaria
  vehiculoSelect.addEventListener('change', actualizarInstructorSelect);
  franjaHorariaSelect.addEventListener('change', actualizarInstructorSelect);

  function actualizarInstructorSelect() {
   // alert("Hay cambios que atender");

    var vehiculoSeleccionado = vehiculoSelect.value;
    var franjaHorariaSeleccionada = franjaHorariaSelect.value;

    // Buscar el horario que coincide con el vehículo y franja horaria seleccionados
    var horarioSeleccionado = $horarios.find(function(horario) {
      return horario.vehiculo.id === parseInt(vehiculoSeleccionado) &&
             horario.franjaHoraria.id === parseInt(franjaHorariaSeleccionada);
    });

    // Si se encuentra un horario que coincide, seleccionar automáticamente el instructor en el select
    if (horarioSeleccionado) {
      instructorSelect.value = horarioSeleccionado.instructor.id;
    }
  }
});


</script>



@stop
