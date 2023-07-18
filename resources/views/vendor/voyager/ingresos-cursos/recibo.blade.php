<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/grid2.css">
    <title>Recibo</title>
    
    <style>
		table {
			border:1px solid #b3adad;
			border-collapse:collapse;
			padding:5px;
		}
		table th {
			border:1px solid #b3adad;
			padding:5px;
			background: #f0f0f0;
			color: #313030;
		}
		table td {
			border:1px solid #b3adad;
			text-align:center;
			padding:5px;
			background: #ffffff;
			color: #313030;
		}
	</style>

</head>
<body>
    
    {{-- <img class="img-responsive" 
    src="{{asset("images\cabeza.jpg")}}"  alt=""> --}}

    <div class="container">

      <div class="filas">
          <div class="cabeza">
            <div align = "center">
              <h1>AUTOESCUELA CHACO</h1>
              <h1>Escuela de Conducción</h1>
               <h1>Recibo Nro {{$datoscobranza->id}}</h1> 
              </ div> 
          </div>
          <div class="cuerpo">
             
               
               <hr />
               <h3>Fecha: {{$datoscobranza->fecha}} </h3> 
               <h3>Alumno: {{$datoscobranza->nombre_alumno}}</h3>
               <h3>DNI: {{$datoscobranza->DNI}}</h3>
               <h3>Domicilio: {{$datoscobranza->direccion}}</h3>
               <h3>Curso: {{$datoscobranza->nombre_curso}} </h3>
               <h3>  {{$datoscobranza->caracteristicas}} </h3>  
               <br>
               <br>  
               <hr style="color: rgb(84, 83, 83); background-color: rgb(101, 100, 100); width:100% higth:2px ;" />
               <br>
               <br>
               <h4 >
                 Total Curso: {{number_format($datoscobranza->precio, 2, '.', ',')}} <br>
                 Importe recibido: {{number_format($datoscobranza->importe, 2, '.', ',')}} <br>
                 Modalidad de Pago:  {{$datoscobranza->modalidad_pago}}  <br>
                 Observaciones: {{$datoscobranza->detalle}}  <br>
             
               <br>
               </h4>
               <hr />
               <div align = "right">
               Direccion: {{$datossucursal->direccion}}  <br>
               Telefono: {{$datossucursal->telefono}}  <br>
               Celular: {{$datossucursal->celular}}  <br>
               </ div> 
               <br>
               <p>
               <br>
               <br>
               </p>
               
              

          </div>
          <div class="pie"></div>
      </div>
      </div>


    
</body>

</html>