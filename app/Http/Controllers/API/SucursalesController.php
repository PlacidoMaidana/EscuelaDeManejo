<?php

namespace App\Http\Controllers\API;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

use App\Sucursale;

class SucursalesController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index(Request $request)
    {
        // Obtener todas las sucursales
        $sucursales = Sucursale::all();
        return response()->json($sucursales);
    }


    public function guardarDatos(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'list_price' => 'required|numeric', // Cambiado de decimal a numeric
        ]);
        

        // Extraemos los datos validados
        $name = $validated['name'];
        $list_price = $validated['list_price'];

        // Creamos la línea que vamos a guardar en el archivo de texto
        $linea = "Producto: $name, Precio: $list_price\n";

        // Definimos la ruta y nombre del archivo de texto
        $rutaArchivo = storage_path('app/datos.txt');

        // Escribimos la línea en el archivo de texto
        File::append($rutaArchivo, $linea);

        return response()->json(['message' => 'Datos guardados correctamente'], 200);
    }


    public function datosVentaWeb(Request $request)
    {


        // Escribir el JSON recibido en un archivo de depuración
        File::append(storage_path('app/debug_payload.txt'), now() . " - Payload recibido:\n" . json_encode($request->all(), JSON_PRETTY_PRINT) . "\n\n");


        try {
            $validated = $request->validate([
                'partner.name' => 'required|string|max:255',
                'partner.email' => 'nullable|email|max:255',
                'partner.phone' => 'nullable|string|max:50',
                'partner.street' => 'nullable|string|max:255',
                'partner.city' => 'nullable|string|max:255',
                'partner.zip' => 'nullable|string|max:20',
                'partner.state' => 'nullable|string|max:100',
                'partner.country' => 'nullable|string|max:100',
            
                'amount_total' => 'required|numeric',
            
                'order_lines' => 'required|array',
                'order_lines.*.product' => 'required|string',
                'order_lines.*.quantity' => 'required|numeric',
                'order_lines.*.price_unit' => 'required|numeric',
            ]);
            
    
            $linea = "Cliente: {$validated['partner']['name']}\n";
            $linea .= "Email: {$validated['partner']['email']}\n";
            $linea .= "Teléfono: {$validated['partner']['phone']}\n";
            $linea .= "Dirección: {$validated['partner']['street']}, {$validated['partner']['city']} {$validated['partner']['zip']} - {$validated['partner']['state']}, {$validated['partner']['country']}\n";
            $linea .= "Total: {$validated['amount_total']}\n";
            $linea .= "Líneas de venta:\n";

            foreach ($validated['order_lines'] as $line) {
                $linea .= "- Producto: {$line['product']}, Cantidad: {$line['quantity']}, Precio Unitario: {$line['price_unit']}\n";
            }

            $linea .= "-------------------------\n";
            File::append(storage_path('app/datos.txt'), $linea);

    
            return response()->json(['message' => 'Datos de venta guardados correctamente'], 200);
    
        } catch (ValidationException $e) {
            File::append(storage_path('app/error_log.txt'), json_encode($e->errors(), JSON_PRETTY_PRINT) . "\n");
            return response()->json(['error' => $e->errors()], 422);
    
        } catch (\Exception $e) {
            File::append(storage_path('app/error_log.txt'), $e->getMessage() . "\n");
            return response()->json(['error' => $e->getMessage()], 500);
        }

       
    }

    public function VentaWeb_AlumnoCursos(Request $request)
{
    // Escribir el JSON recibido en un archivo de depuración
    File::append(storage_path('app/debug_payload.txt'), now() . " - Payload recibido:\n" . json_encode($request->all(), JSON_PRETTY_PRINT) . "\n\n");

    

    try {
        // Iniciar la transacción
        DB::beginTransaction();

        DB::listen(function ($query) {
            File::append(
                storage_path('app/debug_payload.txt'),
                now() . " - Consulta ejecutada: {$query->sql} \nValores: " . json_encode($query->bindings) . "\nTiempo: {$query->time}ms\n\n"
            );
        });

        // Validar los datos recibidos
        $validated = $request->validate([
            'partner.name' => 'required|string|max:255',
            'partner.email' => 'nullable|email|max:255',
            'partner.phone' => 'nullable|string|max:50',
            'partner.street' => 'nullable|string|max:255',
            'partner.city' => 'nullable|string|max:255',
            'partner.zip' => 'nullable|string|max:20',
            'partner.state' => 'nullable|string|max:100',
            'partner.country' => 'nullable|string|max:100',
            'order_lines' => 'required|array',
            'order_lines.*.product' => 'required|string',
        ]);

        // Crear registro en la tabla alumnos
        $alumno = DB::table('alumnos')->insertGetId([
            'nombre' => $validated['partner']['name'],
            'direccion' => $validated['partner']['street'],
            'mail' => $validated['partner']['email'] ?? 'NULL',
            'telefono' => $validated['partner']['phone'] ?? 'NULL',
            'created_at' => now(),
            'updated_at' => now(),
            'foto' => 'NULL',
            'DNI' => 11,
            'id_localidad' => 1,
            'fecha_nacimiento' => now(),
            'genero' => 'O',
        ]);

        // Obtener el ID del curso según su nombre
        $nombre_curso = $validated['order_lines'][0]['product'];
        $curso = DB::table('cursos')->where('nombre_curso', $nombre_curso)->first();
        if (!$curso) {
            throw new \Exception("No se encontró el curso: {$nombre_curso}");
        }

        // Crear registro en la tabla alumnos_cursos
        DB::table('alumnos_cursos')->insert([
            'id_curso' => $curso->id,
            'id_alumno' => $alumno,
            'id_sucursal' => 2,//Resistencia
            'fecha_inscripcion' => now(),
            'id_vendedor' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            'precio' => $validated['order_lines'][0]['price_unit'],
            'activo' => 'SI',
            'compromiso' => NULL,
            'observaciones' => NULL,
            'permiso_compartir_fotos' => false,
        ]);

        // Confirmar la transacción
        DB::commit();
        File::append(storage_path('app/registro_alumnos.txt'), "Alumno creado: {$validated['partner']['name']} - Curso: {$nombre_curso}\n");
        return response()->json(['message' => 'Registros creados correctamente'], 200);

    } catch (ValidationException $e) {
        // Revertir la transacción en caso de error
        DB::rollBack();
        File::append(storage_path('app/error_log.txt'), json_encode($e->errors(), JSON_PRETTY_PRINT) . "\n");
        return response()->json(['error' => $e->errors()], 422);
    } catch (\Exception $e) {
        // Revertir la transacción en caso de error
        DB::rollBack();
        File::append(storage_path('app/error_log.txt'), $e->getMessage() . "\n");
        return response()->json(['error' => $e->getMessage()], 500);
    }
}


public function exportarUltimosRegistros()
{
    try {
        // Consultar los últimos 20 registros de la tabla 'alumnos'
        $ultimosAlumnos = DB::table('alumnos')
            ->orderBy('created_at', 'desc')
            ->take(20)
            ->get();

        // Consultar los últimos 20 registros de la tabla 'alumnos_cursos'
        $ultimosAlumnosCursos = DB::table('alumnos_cursos')
            ->orderBy('created_at', 'desc')
            ->take(20)
            ->get();

        // Escribir los datos de 'alumnos' en un archivo
        File::put(
            storage_path('app/ultimos_alumnos.txt'),
            now() . " - Últimos 20 registros de alumnos:\n" . json_encode($ultimosAlumnos, JSON_PRETTY_PRINT)
        );

        // Escribir los datos de 'alumnos_cursos' en otro archivo
        File::put(
            storage_path('app/ultimos_alumnos_cursos.txt'),
            now() . " - Últimos 20 registros de alumnos_cursos:\n" . json_encode($ultimosAlumnosCursos, JSON_PRETTY_PRINT)
        );

        return response()->json(['message' => 'Registros exportados correctamente'], 200);

    } catch (\Exception $e) {
        // Registrar el error en un archivo de depuración
        File::append(storage_path('app/error_log.txt'), $e->getMessage() . "\n");
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

}

