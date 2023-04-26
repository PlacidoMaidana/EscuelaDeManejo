<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('Alumnos_elegir', 'App\Http\Controllers\AlumnoBrebeController@alumno_elegir');
Route::get('/Alumnos_curso','App\Http\Controllers\voyager\Alumnos_CursosController@index');


//|##############################################|
//|           Calendario del alumno              |
//|##############################################|
Route::get('/calendario/{idAlumnoCurso}','App\Http\Controllers\CalendarioController@index');
Route::get('/calendario/mostrar','App\Http\Controllers\CalendarioController@show');
Route::post('/calendario/agregar','App\Http\Controllers\CalendarioController@store');
Route::post('/calendario/editar/{id}','App\Http\Controllers\CalendarioController@edit');
Route::post('/calendario/actualizar/{evento}','App\Http\Controllers\CalendarioController@update');
Route::post('/calendario/borrar/{id}','App\Http\Controllers\CalendarioController@destroy');
//|##############################################|
//|           Calendario del Instructor              |
//|##############################################|
Route::get('/calendario_instructor/{idInstructor}','App\Http\Controllers\Calendario_instructorController@index');
Route::get('/calendario_instructor/mostrar','App\Http\Controllers\Calendario_instructorController@show');
Route::post('/calendario_instructor/agregar','App\Http\Controllers\Calendario_instructorController@store');
Route::post('/calendario_instructor/editar/{id}','App\Http\Controllers\Calendario_instructorController@edit');
Route::post('/calendario_instructor/actualizar/{evento}','App\Http\Controllers\Calendario_instructorController@update');
Route::post('/calendario_instructor/borrar/{id}','App\Http\Controllers\Calendario_instructorController@destroy');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});


//////////////////////////////////////////////////////////
// GRILLA DE CURSOS ALUMNOS
//////////////////////////////////////////////////////////


Route::get('/cursos_activos/{sucursal}', 'App\Http\Controllers\voyager\Alumnos_CursosController@alumnos_por_sucursal_activos');
Route::get('/cursos_terminados/{sucursal}', 'App\Http\Controllers\voyager\Alumnos_CursosController@alumnos_por_sucursal_terminados');
Route::get('/create_alumno_curos/{id_alumno_curso}', 'App\Http\Controllers\IngresosCursosController@create_alumno_cursos');

Route::get('/Informeingresos','App\Http\Controllers\informes_tesoreria@index_ing');
Route::get('/Informeegresos','App\Http\Controllers\informes_tesoreria@index_egr');
Route::get('/Informecomisiones','App\Http\Controllers\informes_ventas_comisiones@index');
Route::get('/Informeclasescomisiones','App\Http\Controllers\informes_clases_comisiones@index');
Route::get('/informe_flujofinanciero', 'App\Http\Controllers\informes_flujofinancieroController@index');

Route::get('/informeingresos_rango_de_fechas/{from}/{to}','App\Http\Controllers\informes_tesoreria@ing_en_rango_de_fechas');//ruta que devuelve datos
Route::get('/totalesingresos_rango_de_fechas/{from}/{to}','App\Http\Controllers\informes_tesoreria@ing_totales_en_rango_de_fechas');//ruta que devuelve datos
Route::get('/informeegresos_rango_de_fechas/{from}/{to}','App\Http\Controllers\informes_tesoreria@egr_en_rango_de_fechas');//ruta que devuelve datos
Route::get('/totalesegresos_rango_de_fechas/{from}/{to}','App\Http\Controllers\informes_tesoreria@egr_totales_en_rango_de_fechas');//ruta que devuelve datos

Route::get('/informeflujofinanciero_rango_de_fechas/{anio}','App\Http\Controllers\informes_flujofinancieroController@en_rango_de_fechas');//ruta que devuelve datos

Route::get('/informevtasComisiones_rango_de_fechas/{from}/{to}','App\Http\Controllers\informes_ventas_comisiones@en_rango_de_fechas');//ruta que devuelve datos
Route::get('/totalesvtasComisiones_rango_de_fechas/{from}/{to}','App\Http\Controllers\informes_ventas_comisiones@totalesen_rango_de_fechas');//ruta que devuelve datos
Route::get('/informeclasesComisiones_rango_de_fechas/{from}/{to}','App\Http\Controllers\informes_clases_comisiones@en_rango_de_fechas');//ruta que devuelve datos
Route::get('/totalesclasesComisiones_rango_de_fechas/{from}/{to}','App\Http\Controllers\informes_clases_comisiones@totalesen_rango_de_fechas');//ruta que devuelve datos

Route::get('informes_tesoreria/ing_export/{from}/{to}', 'App\Http\Controllers\informes_tesoreria@ing_export');
Route::get('informes_tesoreria/egr_export/{from}/{to}', 'App\Http\Controllers\informes_tesoreria@egr_export');
Route::get('informes_flujofinanciero/export/{anio}', 'App\Http\Controllers\informes_flujofinancieroController@export');
Route::get('informes_ventasComisiones/export/{from}/{to}', 'App\Http\Controllers\informes_ventas_comisiones@export');
Route::get('informes_clasesComisiones/export/{from}/{to}', 'App\Http\Controllers\informes_clases_comisiones@export');
