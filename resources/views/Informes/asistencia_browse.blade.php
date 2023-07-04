{{-- @extends('voyager::master') --}}
@extends('layouts.voyager2')

@section('page_title', __('voyager::generic.viewing').' '.'Registro de Asistencia')

@section('content')





<h3> Registro de Asistencia de Alumnos:  </h3>

<div class="form-group col-md-2 ">
  <label for="">fecha</label>
  <br>
  <input type="date"  id="fecha" class="form-control" placeholder="" aria-describedby="helpId">
</div>

<div class="form-group col-md-2 ">
  <label for="id">Franjas horarias</label>
  <select name="franja_horaria" id="franjahoraria_selected">
    @foreach ($franjasHorarias as $franjaHoraria)
        <option value="{{ $franjaHoraria->id }}">{{ $franjaHoraria->descripcion }}</option>
    @endforeach
</select>
</div>

<div class="row ">
  <div class="col-md-2  ">
    <button  type="button" id="lista alumnos"   class="btn btn-sm btn-primary" >Buscar Alumnos</button>
  </div>    

  <button  type="button" id="marca_asistencia" class="btn btn-sm btn-primary"  >marcar asistencia</button>
</div>

 


<table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:60%">
    <thead>
      <tr>
        <th class="dt-not-orderable">
          <input type="checkbox" class="select_all">
        </th>
        <th>Alumno</th>
        <th>Curso</th>
        <th>Fecha</th>
        <th>Descripcion Clase</th>
        <th>Tipo Clase</th>
        <th>Instructor</th>
        <th>Asistencia</th>
        <th>Franja Horaria</th>
        <th>Acciones</th>
      </tr>
     </thead>
     
</table>
  
@stop

@section('css')

@stop

@section('javascript')

<script>
  $("#btnLimpiar").click(function(event) {
    $("#formFecha")[0].reset();
  });

  // Obtener las variables de Laravel y asignarlas a variables de JavaScript
  var variable1 = @json($fecha);
  var variable2 = @json($horario);

  // Construir la URL utilizando las variables de Laravel
  var url = "{{ url('/asistencia_clases/') }}" + variable1 + "/" + variable2;


  $(document).ready(function() {
     if (#franjahoraria_selected= "") {
        #franjahoraria_selected=2;
      }
    var filtro = "{{ url('/asistencia_clases/') }}" + "/" + $("#franjahoraria_selected").val() + '/' + $("#fecha").val();

    function filtrar() {
     
      if (url != "") {
        filtro = url;
      }
              
      $('#example').dataTable({
        "serverSide": true,
        "ajax": filtro,
        "paging": true,
        "searching": true,
        "columns": [
          { data: 'check', width: '5%' },
          { data: 'nombre', name: 'alumnos.nombre', width: '10%' },
          { data: 'nombre_curso', name: 'cursos.nombre_curso', width: '10%' },
          { data: 'fecha', name: 'alumno_evento.start_date', width: '10%' },
          { data: 'clase', name: 'alumno_evento.descripcion', width: '10%' },
          { data: 'tipo_evento', name: 'tipos_eventos.tipo_evento', width: '10%' },
          { data: 'nombre_instructor', name: 'instructores.nombre', width: '10%' },
          { data: 'asistencia', name: 'alumno_evento.asistencia', width: '10%' },
          { data: 'descripcion', name: 'franjas_horarias.descripcion', width: '10%' },
          { data: 'accion', width: '10%' },
        ]
      });

    };
    filtrar();
  });



  var button = document.getElementById("lista alumnos" );
  button.addEventListener("click", function() {
    filtrar();
    });


  // Obtenemos una referencia al botón
  var button = document.getElementById("marca_asistencia");

  // Agregamos un event listener para el evento "click"
  button.addEventListener("click", function() {
    const fecha = document.getElementById('fecha');
    const horario = document.getElementById('franjahoraria_selected');

    const fecha_val = fecha.value;
    const horario_val = horario.value;

    const ruta = '/Registra_asistencia_clases/' + fecha_val + '/' + horario_val;
    const filtro = "{{ url('') }}" + ruta;

    alert(filtro);

    window.location.href = filtro;
  });
</script>

  
 
@stop
