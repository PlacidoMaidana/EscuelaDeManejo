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
             <input type="checkbox" name="check_lista[]" class="select_all">
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
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
  $("#btnLimpiar").click(function(event) {
    $("#formFecha")[0].reset();
  });

  // Obtener las variables de Laravel y asignarlas a variables de JavaScript
  var variable1 = "{{$fecha}}";
  var variable2 = "{{$horario}}";
  
  // Construir la URL utilizando las variables de Laravel
  var url = "{{ url('/asistencia_clases/') }}/" + variable2 + "/" + variable1;
  
  function guardarUrl(parametro_url,parametro_fecha,parametro_hora) {
  
  // Realizar la solicitud a través de Axios
  axios.post("{{url('/asistencia_clases_guardarurl/')}}", {
    url: parametro_url, // Aquí puedes pasar la URL que deseas almacenar en la sesión
    fecha: parametro_fecha, // Aquí puedes pasar la URL que deseas almacenar en la sesión
    hora: parametro_hora // Aquí puedes pasar la URL que deseas almacenar en la sesión
  })
  .then(function (response) {
    console.log("volvio del controlador la url llevada es "+ response.data.url);
    
    console.log(response.data); // Puedes hacer algo con la respuesta del controlador si es necesario
  })
  .catch(function (error) {
    console.log(error);
  });
}

  function filtrar() {
     
     // Obtener la fecha actual
     var fechaControl = $("#fecha").val();
     // Obtener la franja horaria seleccionada
     var franjaHorariaControl = $("#franjahoraria_selected").val();

     // Verificar si no se ha seleccionado una fecha o franja horaria
        if (fechaControl === "") {
        
          fechaControl="{{$fecha}}" ;
          franjaHorariaControl="{{$horario}}";
         // alert(fechaControl+"   "+franjaHorariaControl);
        }
      // Verificar si no se ha seleccionado una fecha o franja horaria

      var filtro = "{{ url('/asistencia_clases/') }}/"+franjaHorariaControl+"/"+fechaControl;
      guardarUrl(filtro,fechaControl,franjaHorariaControl);
      //alert(filtro);

      // Destruir el DataTable existente
      $('#example').DataTable().destroy();


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



  $(document).ready(function() {
        
    filtrar();
  });

</script>

<script>
  var button = document.getElementById("lista alumnos" );
  button.addEventListener("click", function() {
    
    filtrar();
    });

</script>  

<script>
 // Obtenemos una referencia al botón
 var button = document.getElementById("marca_asistencia");
 button.addEventListener("click", function() {

  
        let clases_marcadas = [];
        var table = $("#example").DataTable();
        var data = table.rows().nodes();
        data.each(function (value, index) {
            var valor = value.cells[0].children[0].value;
            var check = value.cells[0].children[0].checked;
            if (check)
            {
              clases_marcadas.push(valor);
            }            
        }); 
   
   
   var url_marca_asistencia = "{{ url('/Registra_asistencia_clases/') }}/"+clases_marcadas;  
   window.location.href =url_marca_asistencia;
   
    });
</script>
 
@stop
