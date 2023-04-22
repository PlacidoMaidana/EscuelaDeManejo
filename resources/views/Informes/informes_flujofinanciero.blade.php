{{-- @extends('voyager::master') --}}
@extends('layouts.voyager2')

@section('page_title', __('voyager::generic.viewing').' '.'Informe de Movimientos Financieros')

@section('content')



<div class="form-group col-md-2 ">
    <label for="">Año</label>
    <input type="year" id="anio" class="form-control" placeholder="" aria-describedby="helpId">
    <small id="helpId" class="text-muted">Año</small>
</div>

<div class="row ">
    <div class="col-md-2  ">
      <button  type="button" id="informe tesoreria"  onclick="filtrar()" class="btn btn-sm btn-primary" >Filtrar movimientos</button>
    </div>    
</div>
<div class="row ">
  <div class="col-md-2  ">
    <button  type="button" id="ver tesoreria"  onclick="excelExport()" class="btn btn-sm btn-primary" >Excel</button>
  </div>    
</div>

<div class="form-group col-md-12 ">
    <table id="movimientos" class="table table-striped table-bordered dt-responsive nowrap" style="width:60%">
        <thead>
          <tr>
            <th>Ingreso-Egreso </th>
            <th>Tipo1</th>
            <th>Tipo2</th>
            <th>Enero</th> 
            <th>Febrero</th> 
            <th>Marzo</th>
            <th>Abril</th>
            <th>Mayo</th>
            <th>Junio</th>
            <th>Julio</th>
            <th>Agosto</th>
            <th>Septiembre</th> 
            <th>Octubre</th>
            <th>Noviembre</th>
            <th>Diciembre</th>
          </tr>
        </thead>
        
    </table>
</div>


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
    //var fechas=$("#fecha_desde").val()+"hasta: "+$("#fecha_hasta").val();
    // var filtro ='/informeflujofinanciero_rango_de_fechas/'+ $("#anio").val();
    var filtro ="{{url('/informeflujofinanciero_rango_de_fechas/')}}"+"/"+ $("#anio").val();
        
    $('#movimientos').dataTable( {
    "serverSide": true,
    "ajax":filtro,
    "paging": true,
    "searching": true,
    "columns":[
            {data:'tipo',name: 'tipo', width: '5%'},
            {data: 'tipo1',name: 'tipo1', width: '5%'},
            {data: 'tipo2',name: 'tipo2', width: '5%'},
            {data: 'Ene',name: 'Ene', width: '5%'},
            {data: 'Feb',name: 'Feb', width: '5%'},
            {data: 'Mar',name: 'Mar', width: '5%'},
            {data: 'Abr',name: 'Abr', width: '5%'},
            {data: 'May',name: 'May', width: '5%'},
            {data: 'Jun',name: 'Jun', width: '5%'},
            {data: 'Jul',name: 'Jul', width: '5%'},
            {data: 'Ago',name: 'Ago', width: '5%'},
            {data: 'Sep',name: 'Sep', width: '5%'},
            {data: 'Octu',name: 'Octu', width: '5%'},
            {data: 'Nov',name: 'Nov', width: '5%'},
            {data: 'Dic',name: 'Dic', width: '5%'}
             ]        
});
 

  }
</script>

<script>
   function excelExport()   {
    window.location.href ="{{url('/informes_flujofinanciero/export/')}}"+"/"+$("#anio").val();
   }
</script>
@stop
