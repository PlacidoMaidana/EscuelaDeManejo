{{-- @extends('voyager::master') --}}
@extends('layouts.voyager2')

@section('page_title', __('voyager::generic.viewing').' '.'Lista de Alumnos por Instructor')

@section('content')
<h3> Lista de Alumnos del Instructor: {{$nombre_instructor->nombre}}  </h3>

<div class="form-group col-md-2 ">
    <label for="">fecha</label>
    <input type="date"  id="fecha" class="form-control" placeholder="" aria-describedby="helpId">
    <small id="helpId" class="text-muted">fecha</small>
</div>

<div class="row ">
    <div class="col-md-2  ">
      <button  type="button" id="lista alumnos"  onclick="filtrar()" class="btn btn-sm btn-primary" >Buscar Alumnos del dia</button>
    </div>    
</div>
<div class="row ">
  <div class="col-md-2  ">
    <button  type="button" id="excel"  onclick="excelExport()" class="btn btn-sm btn-primary" >Excel </button>

    <div style="border: 1px solid #d3d3d3; background-color: #f9f9f9; padding: 10px; display: inline-block;">
        <label style="display: block; font-weight: bold; margin-bottom: 8px;">Reasignar clases a:</label>
        <div style="display: flex; align-items: center; gap: 10px;">
            
            <select id="selectInstructor" class="form-control" style="flex: 1;width: 200px;" >
              <option value="">Seleccione instructor</option>
            </select>
            
            <button id="btnActualizarAlumnos" class="btn btn-success">
              <i class="fas fa-edit"></i> Asignar a nuevo instructor
            </button>


        </div>
    </div>
    
  </div>    
</div>
<table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:60%">
    <thead>
      <tr>
        <th>Seleccionar</th> <!-- nueva columna -->
        <th>Fecha y horario</th>
        <th>Alumno</th>
        <th>Telefono</th>
        <th>Curso</th>
        <th>Nro Clase</th>
        <th>Descripcion Clase</th>
        
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
    </script>


    <script>
    
    $(document).ready(function() {
           

</script> 

<script>

  function filtrar() {
    var filtro ="{{url('/alumnos_instructor_por_fecha/')}}"+"/"+{{$idInstructor}}+"/"+$("#fecha").val();
    console.log(filtro);
    $('#example').dataTable( {
    "serverSide": true,
    "ajax":filtro,
    "paging": true,
    "searching": true,
    "columns":[
            {
              data: 'id',
              render: function(data) {
                  return `<input type="checkbox" class="alumno-check" value="${data}">`;
              },
              orderable: false
            },
            {data: 'start_date', name: 'alumno_evento.start_date', width: '5%'},
            {data: 'nombre', name:'alumnos.nombre', width: '10%'},
            {data: 'telefono', name: 'alumnos.telefono', width: '10%'},
            {data: 'nombre_curso', name: 'cursos.nombre_curso', width: '10%'},
            {data: 'clase', name: 'alumno_evento.clase', width: '10%'},
            {data: 'descripcion', name: 'alumno_evento.descripcion', width: '10%'},
          ]        
});
    
  }
</script>

<script>
    function excelExport()   {
    window.location.href = '/alumnos_instructor/export/'+{{$idInstructor}}+'/'+$("#fecha").val();
   }
</script>

<script>
     $('#btnActualizarAlumnos').on('click', function() {
      let idsSeleccionados = [];
      $('.alumno-check:checked').each(function() {
        idsSeleccionados.push($(this).val());
      });
    
      const nuevoInstructorId = $('#selectInstructor').val();
    
      if (!nuevoInstructorId) {
        alert('⚠️ Por favor, seleccioná un instructor.');
        return;
      }
    
      fetch('/calendario-instructor/actualizar-alumnos', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ ids: idsSeleccionados, instructor_id: nuevoInstructorId })
      })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          alert('✅ Clases reasignadas con éxito');
        }
      });
    });
</script>

<script>

  function cargarInstructores(sucursalId) {
  $.ajax({
    url: `/instructores_sucursal/${sucursalId}`,
    method: 'GET',
    success: function(response) {
      $('#selectInstructor').empty().append('<option value="">Seleccione instructor</option>');
      response.data.forEach(function(instructor) {
        $('#selectInstructor').append(
          `<option value="${instructor.id}">${instructor.nombre}</option>`
        );
      });
    },
    error: function() {
      alert("Error al obtener instructores.");
    }
  });
}
  
</script>
<script >
  $(document).ready(function() {
  const sucursalId = {{ $sucursal }}; // El código de la sucursal es obtenido en el metodo "listas_alumnos_instructor"
  cargarInstructores(sucursalId);
});  
</script>

@stop
