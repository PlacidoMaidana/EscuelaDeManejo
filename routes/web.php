<?php

use Illuminate\Support\Facades\Route;
use App\AlumnoEvento;

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
Route::get('/calendario_modificar/','App\Http\Controllers\CalendarioController@calendario_modificar')->name('calendario.modificar');;
Route::get('/calendario/mostrar','App\Http\Controllers\CalendarioController@show');
Route::post('/calendario/agregar','App\Http\Controllers\CalendarioController@store');
Route::get('/calendario/editar/{id}','App\Http\Controllers\CalendarioController@edit');
Route::get('/calendario/editar_calendario/{id}','App\Http\Controllers\CalendarioController@edit_calendario_por_instructor');
Route::post('/calendario/actualizar/{evento}','App\Http\Controllers\CalendarioController@update');
Route::post('/calendario/borrar/{id}','App\Http\Controllers\CalendarioController@destroy');
Route::get('/calendario/obtener_fechas/{franjaHoraria}/{diaEvento}','App\Http\Controllers\CalendarioController@obtener_fechas');
Route::get('/calendario/eventos_alumno/{idAlumnoCurso}','App\Http\Controllers\CalendarioController@eventos_alumno');
//Route::get('/obtener-eventos/{idVehiculo}/{idHorario}', 'App\Http\Controllers\CalendarioController@obtener_eventos');
Route::get('/obtener-eventos/{idVehiculo}', 'App\Http\Controllers\CalendarioController@obtener_eventos');
Route::get('/obtener-eventos-por-instructor/{idInstructor}', 'App\Http\Controllers\CalendarioController@obtener_eventos_por_instructor');


//|##############################################|
//|           Calendario del Instructor          |
//|##############################################|
Route::get('/instructores_calendario','App\Http\Controllers\Calendario_instructorController@lista_instructores_sucursal');
Route::get('/instructores_sucursal/{sucursal}','App\Http\Controllers\Calendario_instructorController@query_instructores_sucursal');//ruta que devuelve datos


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


Route::get('/egresos_por_sucursal/{sucursal}', 'App\Http\Controllers\voyager\EgresosController@egresos_por_sucursal');
Route::get('/cursos_activos/{sucursal}', 'App\Http\Controllers\voyager\Alumnos_CursosController@alumnos_por_sucursal_activos');
Route::get('/cursos_terminados/{sucursal}', 'App\Http\Controllers\voyager\Alumnos_CursosController@alumnos_por_sucursal_terminados');
Route::post('/alta_alumno', 'App\Http\Controllers\voyager\Alumnos_CursosController@alta_alumno');
Route::get('/create_pago_alumno/{id_alumno_curso}', 'App\Http\Controllers\IngresosCursosController@create_pago_cursos');

///  pagos de alumnos  
Route::get('/pagos_alumno/{idAlumnoCurso}','App\Http\Controllers\voyager\Alumnos_CursosController@lista_pagos_alumnos'); // va la grilla
Route::get('/datos_pagos_alumno/{idAlumnoCurso}','App\Http\Controllers\voyager\Alumnos_CursosController@pagos_alumnos'); // devuelve datos
Route::get('/admin/ingresos-cursos/{id}/recibo_cobranza', 'App\Http\Controllers\voyager\Alumnos_CursosController@recibo_cobranza'); 


////
///  clases de alumnos
Route::get('/seguimiento_alumno/{idAlumnoCurso}','App\Http\Controllers\voyager\Alumnos_CursosController@lista_clases_alumnos'); // va la grilla
Route::get('/clases_seguimiento_alumno/{idAlumnoCurso}','App\Http\Controllers\voyager\Alumnos_CursosController@seguimiento_clases_alumnos'); // devuelve datos
/////
Route::get('/listas_alumnos_instructor/{idInstructor}','App\Http\Controllers\Calendario_instructorController@lista_alumnos_instructor_fecha');
Route::get('/alumnos_instructor_por_fecha/{idInstructor}/{from}','App\Http\Controllers\Calendario_instructorController@alumnos_instructor_por_fecha');//ruta que devuelve datos

//Route::get('/RegistroAsistencia/','App\Http\Controllers\RegistroAsistencia@index');
Route::get('/RegistroAsistencia/','App\Http\Controllers\RegistroAsistencia@index');
Route::get('/Registra_asistencia_clases/{clases_marcadas}','App\Http\Controllers\RegistroAsistencia@actualiza_asistencia');
Route::get('/asistencia_clases/{franjahoraria}/{from}','App\Http\Controllers\RegistroAsistencia@asistencia_clases_por_fecha');//ruta que devuelve datos
Route::post('/asistencia_clases_guardarurl/','App\Http\Controllers\RegistroAsistencia@guardarUrl');



Route::get('/Informeingresossucursal','App\Http\Controllers\informes_tesoreria@index_ing_suc');

Route::get('/Cajadiaria','App\Http\Controllers\informes_tesoreria@index_caja_diaria_operador');
Route::get('/Informe_cajadiaria','App\Http\Controllers\informes_tesoreria@index_caja_diaria');
Route::get('/Informeingresos','App\Http\Controllers\informes_tesoreria@index_ing');
Route::get('/Informeegresos','App\Http\Controllers\informes_tesoreria@index_egr');
Route::get('/Informecomisiones','App\Http\Controllers\informes_ventas_comisiones@index');
Route::get('/Informeclasescomisiones','App\Http\Controllers\informes_clases_comisiones@index');
Route::get('/informe_flujofinanciero', 'App\Http\Controllers\informes_flujofinancieroController@index');

Route::get('/informe_cajadiaria_fecha_operador_egr/{fecha}/{operador}','App\Http\Controllers\informes_tesoreria@cajadiaria_fecha_operador_egr');//ruta que devuelve datos
Route::get('/informe_cajadiaria_fecha_operador_ing/{fecha}/{operador}','App\Http\Controllers\informes_tesoreria@cajadiaria_fecha_operador_ing');//ruta que devuelve datos
Route::get('/totales_caja_diaria/{fecha}/{operador}','App\Http\Controllers\informes_tesoreria@cajadiaria_fecha_operador_totales');//ruta que devuelve datos

Route::get('/informeingresos_suc_rango_de_fechas/{from}/{to}','App\Http\Controllers\informes_tesoreria@ing_suc_en_rango_de_fechas');//ruta que devuelve datos
Route::get('/totalesingresos_suc_rango_de_fechas/{from}/{to}','App\Http\Controllers\informes_tesoreria@ing_suc_totales_en_rango_de_fechas');//ruta que devuelve datos
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
Route::get('informes_tesoreria/caja_export/{fecha}/{operador}', 'App\Http\Controllers\informes_tesoreria@caja_export');
Route::get('informes_flujofinanciero/export/{anio}', 'App\Http\Controllers\informes_flujofinancieroController@export');
Route::get('informes_ventasComisiones/export/{from}/{to}', 'App\Http\Controllers\informes_ventas_comisiones@export');
Route::get('informes_clasesComisiones/export/{from}/{to}', 'App\Http\Controllers\informes_clases_comisiones@export');
Route::get('alumnos_instructor/export/{instructor}/{fecha}', 'App\Http\Controllers\Calendario_instructorController@export');
Route::get('seguimiento_alumno_export/{id_alumno_curso}' , 'App\Http\Controllers\voyager\Alumnos_CursosController@export');


Voyager::routes();

Route::get('/dashboard', 'CustomDashboardController@index')->name('voyager.dashboard.custom');

