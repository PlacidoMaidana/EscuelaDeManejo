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

                <h1>Esta es la pagina para el calendario</h1>
                
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
                          <label for="clase"></label>
                          <input type="text" class="form-control" name="clase" id="clase" aria-describedby="helpId" placeholder="">
                          <small id="helpId" class="form-text text-muted">Clase</small>
                        </div>

                        <div class="form-group">
                          <label for="start_date"></label>
                          <input type="date" class="form-control" name="start_date" id="start_date" aria-describedby="helpId" placeholder="">
                          <small id="helpId" class="form-text text-muted">start_date</small>
                        </div>

                        <div class="form-group">
                            <label for="end_date"></label>
                            <input type="date" class="form-control" name="end_date" id="end_date" aria-describedby="helpId" placeholder="">
                            <small id="helpId" class="form-text text-muted">end_date</small>
                        </div>

                       </form>



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" id="btn-guardar">Guardar</button>
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
                $('#ModCalendario').modal("show");
            },
            

          events: @json($events) 
        });
        calendar.setOption('locale','Es');
        calendar.render();

        document.getElementById("btn-guardar").addEventListener("click",function(){
            const datos= new FormData(formulario);
            console.log(datos.get('start_date'));
            console.log(formulario.clase.value);
           
            axios.post("http://127.0.0.1:8000/calendario/agregar", datos)
            .then(
                (respuesta)=>{
                    console.log(respuesta);
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
@stop
