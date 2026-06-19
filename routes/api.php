<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\voyager\Alumnos_CursosController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\API\SucursalesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});




Route::post('login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->get('/sucursales', [SucursalesController::class, 'index']);

Route::middleware('auth:sanctum')->post('/guardar-datos', [SucursalesController::class, 'guardarDatos']);
Route::middleware('auth:sanctum')->post('/datos_venta_web', [SucursalesController::class, 'datosVentaWeb']);
Route::middleware('auth:sanctum')->post('/venta_web_alumnos_cursos', [SucursalesController::class, 'VentaWeb_AlumnoCursos']);


// PROBANDO EL EXITO DE LA API DESDE ODOO
// http://tu-dominio/api/exportar-ultimos-registros



Route::get('/exportar-ultimos-registros', [SucursalesController::class, 'exportarUltimosRegistros']);