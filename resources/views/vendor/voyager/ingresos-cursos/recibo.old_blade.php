<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/grid2.css">
    <title>Recibo</title>
    
    <style>
      /* Estilos CSS para el recibo */
      body {
          font-family: Arial, sans-serif;
      }

      .header {
          text-align: center;
          font-size: 24px;
          margin-bottom: 20px;
      }

      .recipient-info {
          margin-bottom: 10px;
      }

      /*.table {
        background-image: url('img/reciboFondo.jpg');
        background-size: cover;
        background-repeat: no-repeat;
       }*/
     
       .table th, .table td {
           border: 1px solid #000;
           padding: 8px;
          /* background-color: rgba(255, 255, 255, 0.8);  Color de fondo transparente para hacer legible el contenido */
       }

       /* Estilos para la cabecera de la tabla */
       .table thead {
            background-color: #595959;
            color: #fff;
        }

        /* Estilos para la caja gris */
        .gray-box {
            background-color: #595959;
            color: #fff;
            padding: 10px;
            font-weight: bold;
            font-size: 18px;
        }

      .total {
          font-weight: bold;
          text-align: right;
      }

       /* Estilos para el recuadro */
       .recuadro {
            border: 1px solid #000;
            padding: 10px;
            display: inline-block;
            font-weight: bold;
            font-size: 35px;
        }

         /* Estilos para el contenido con imagen de fondo */
         .content-with-background {
            background-image: url('img/reciboFondo.jpg'); /* Ruta de la imagen de fondo */
            background-position: center; 
            background-size: contain;
            background-repeat: no-repeat;
            padding: 20px;
            color: #0f0f0f;
        }


  </style>

   

</head>
<body>
    
    {{-- <img class="img-responsive" 
    src="{{asset("images\cabeza.jpg")}}"  alt=""> --}}

    <div class="container">

      <div class="filas">
        <div class="header">
            <div align="center">
                <h1 style="margin: 0;"><div class="recuadro">AUTOESCUELA CHACO</div></h1>
                <h5 style="margin: 5px 0;">Escuela de conducción</h5>
                <h5 style="margin: 5px 0;">Recibo Nro {{$datoscobranza->id}}</h5>
                <h5 style="margin: 5px 0;">Resistencia: {{$datoscobranza->fecha}}</h5>
            </div>
        </div>
       
          <div class="cuerpo">
             
         
            <div class="content-with-background">
               <hr />
               
               <h5>Alumno: {{$datoscobranza->nombre_alumno}}</h5>
               <h5>DNI: {{$datoscobranza->DNI}}</h5>
               <h5>Domicilio: {{$datoscobranza->direccion}}</h5>
                          
               <div class="table">
                <table>
                    <thead >
                        <tr>
                        <!-- Caja gris para otra sección del recibo -->
                         <div class="gray-box">
                             Detalles del curso
                         </div>         
                        </tr>
                    </thead>
                    <tbody>
                        
                        <tr><td>Curso: {{$datoscobranza->nombre_curso}}</td></tr>
                        <tr><td> {{$datoscobranza->caracteristicas}} </td></tr>
                        
                    </tbody>
                   
                </table>
            </div>
           
           <!-- Caja gris para otra sección del recibo -->
           <div class="gray-box">
               Datos del pago
           </div>
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
               
       
                <!-- La tabla y el resto del contenido de ejemplo pueden quedar después del contenido del documento de Word o ajustarlo según tus necesidades -->

    



          </div>
          <div class="pie"></div>
        </div>       {{-- Termina el contenido con background--}}
      </div>
      </div>


    
</body>

</html>