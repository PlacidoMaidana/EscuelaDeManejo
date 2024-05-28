<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB; // Para usar consultas directas
use App\Alumno;
use Carbon\Carbon;

class AsistenciaCamaraController extends Controller
{
    
    public function showAsistenciaCamara()
    {
        return view('vendor.voyager.alumnos-cursos.asistencia_camara');
    }

    public function guardaFotoAlumnoBuscado(Request $request)
    {

        // Obtener los datos base64 de la imagen del formulario de registro
        $imageData = $request->input('capturedImageDataInput');

        // Log para verificar si la foto se obtiene correctamente
        logger()->info('Foto recibida:', ['photo' => $imageData]);

        // Decodificar los datos base64 y guardar la imagen en la ubicación adecuada con el nombre de archivo correcto
        if ($imageData) {
            $userId = auth()->user()->id; // Obtener el ID del usuario autenticado
            $imageData = substr($imageData, strpos($imageData, ",") + 1);
            $imageData = base64_decode($imageData);
            // Crear el directorio si no existe
            $pathBuscado = storage_path('app/public/faces');
            if (!file_exists($pathBuscado)) {
                mkdir($pathBuscado, 0755, true);
            }

            // Guardar la imagen en el directorio
            file_put_contents($pathBuscado . '/' . $userId . '.png', $imageData);

            // Log para verificar la ruta donde se guarda la foto
            logger()->info('Foto guardada en:', ['path' => $pathBuscado . '/' . $userId . '.png']);
        }
        return redirect()->back()->with('success', 'Foto guardada correctamente');
    }


    public function mostrarCargarFoto($id)
    {
        // Obtener la información del alumno usando el id
        $alumno = Alumno::find($id);

        return view('vendor.voyager.alumnos-cursos.cargar_foto', ['alumno' => $alumno]);
    }
    public function guardaFotoAlumno(Request $request,$id)// Guarda foto del alta del alumno-curso en deepface/database
    {
      
        //  dd("El id del alumno ".$id);

        // Obtener los datos base64 de la imagen del formulario de registro
        $imageData = $request->input('capturedImageDataInput');

        // Log para verificar si la foto se obtiene correctamente
        logger()->info('Foto recibida:', ['photo' => $imageData]);

        // Decodificar los datos base64 y guardar la imagen en la ubicación adecuada con el nombre de archivo correcto
        if ($imageData) {
            $userId = $id; // El id del alumno-curso seleccionado
            $imageData = substr($imageData, strpos($imageData, ",") + 1);
            $imageData = base64_decode($imageData);
            // Crear el directorio si no existe
            // La foto del alumno se creara en la base de datos usado por Deepface
            $pathDB = 'C:/xampp/htdocs/escuela_de_manejo/deepface/database';
            //dd($path . '/' . $userId . '.png');
            if (!file_exists($pathDB)) {
                mkdir($pathDB, 0755, true);
            }

            //debe ser el id del alumno buscado

            // dd($pathDB . '/' . $userId . '.png');
            // Guardar la imagen en el directorio
            file_put_contents($pathDB . '/' . $userId . '.png', $imageData);

            // Log para verificar la ruta donde se guarda la foto
            logger()->info('Foto guardada en:', ['path' => $pathDB . '/' . $userId . '.png']);
        }else {
            dd('No obtuvo la foto');
        }
        // Redirigir a la URL de crear alumno-curso
       //return redirect()->to('/alumnos-cursos/create')->with('success', 'Foto cargada correctamente.');
       session()->put('nombre_alumno',$request->input('nombre_alumno'));
       session()->put('id_alumno',$id);
        return redirect()->back()->with('success', 'Foto guardada correctamente');
    }


    public function encuentraIdFotoAlumnoCurso()
    {
        // Ruta a la base de datos de imágenes
        // $dbPath = $this->pathDB; // 'C:/xampp/htdocs/deepface/database';
        // Ruta completa al ejecutable de Python
        $pythonPath = 'C:/Users/LENOVO/AppData/Local/Programs/Python/Python312/python.exe';
        //$scriptPath = 'C:/xampp/htdocs/deepface/holamundo.py';
       // $scriptPath = escapeshellcmd("C:/xampp/htdocs/escuela_de_manejo/deepface/pythonTest.py ");
        $scriptPath = "C:/xampp/htdocs/escuela_de_manejo/deepface/pythonTest.py ";

        // Comando para ejecutar el script de Python
        //$command = escapeshellcmd($pythonPath . ' ' . $scriptPath);
        $command = $pythonPath . ' ' . $scriptPath;

        // Ejecutar el comando y capturar la salida
        $output = shell_exec($command . ' 2>&1');

        // Eliminar mensajes de log de TensorFlow y otros mensajes irrelevantes, si es necesario
        // Esto supone que el JSON siempre aparece en la última línea de la salida
        $lines = explode("\n", trim($output));
        $jsonLine = end($lines);
        //dd( $jsonLine);
        // Decodificar la salida JSON del script de Python
        $result = json_decode($jsonLine, true);

        // Obtener el ID del alumno curso
        $alumnoCursoId = $result['alumno_curso_id'] ?? null;
       // dd($alumnoCursoId);
        // Retornar la respuesta como JSON con solo el ID del alumno curso
        /*return response()->json([
        'alumno_curso_id' => $alumnoCursoId
    ]);*/
    }

    public function asistenciaAlumnoCurso()
    {
        // Ruta a la base de datos de imágenes
       // $dbPath = 'C:/xampp/htdocs/deepface/database';
        // Ruta completa al ejecutable de Python
        $pythonPath = 'C:/Users/LENOVO/AppData/Local/Programs/Python/Python312/python.exe';
        //$scriptPath = 'C:/xampp/htdocs/deepface/holamundo.py';
        // $scriptPath = escapeshellcmd("C:/xampp/htdocs/escuela_de_manejo/deepface/pythonTest.py ");
        $scriptPath = "C:/xampp/htdocs/escuela_de_manejo/deepface/pythonTest.py ";

        // Comando para ejecutar el script de Python
        //$command = escapeshellcmd($pythonPath . ' ' . $scriptPath);
        $command = $pythonPath . ' ' . $scriptPath;
        // dd($command);
        // Ejecutar el comando y capturar la salida
        $output = shell_exec($command . ' 2>&1');

        // Eliminar mensajes de log de TensorFlow y otros mensajes irrelevantes, si es necesario
        // Esto supone que el JSON siempre aparece en la última línea de la salida
        $lines = explode("\n", trim($output));
        $jsonLine = end($lines);
        //dd( $jsonLine);
        // Decodificar la salida JSON del script de Python
        $result = json_decode($jsonLine, true);


        // Obtener el ID del alumno curso
        $alumnoCursoId = $result['alumno_curso_id'] ?? null;
        //dd("Id del alumno: ".$alumnoCursoId);
        // Verificar si $alumnoCursoId no es nulo antes de continuar
        if ($alumnoCursoId) {

           // dd($alumnoCursoId);
            // Obtener la fecha de hoy
             $hoy = Carbon::today()->toDateString();
            // Ejemplo de cómo usar $alumnoCursoId para actualizar la asistencia en la base de datos
            DB::table('alumno_evento')
               ->join('alumnos_cursos','alumno_evento.id_alumno_curso','=','alumnos_cursos.id')
                ->join('alumnos','alumnos.id','=','alumnos_cursos.id_alumno')
                ->where('alumnos_cursos.id_alumno', $alumnoCursoId)
                ->whereDate('alumno_evento.start_date', $hoy)
                ->update(['asistencia' => "SI"]);

        


            // Otra lógica de negocio que necesites
            // ...
        } else {
            return response()->json(['error' => 'ID de alumno curso no encontrado'], 400);
        }



        // Retornar la respuesta como JSON con solo el ID del alumno curso
        /*return response()->json([
        'alumno_curso_id' => $alumnoCursoId
    ]);*/
    }

    public function procesarAsistencia(Request $request)
    {
        // Ejecutar el método guardaFotoAlumnoBuscado
        $this->guardaFotoAlumnoBuscado($request);

        // Luego ejecutar el método asistenciaAlumnoCurso
        return $this->asistenciaAlumnoCurso($request);
    }
}
