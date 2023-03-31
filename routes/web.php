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



Route::get('/Alumnos_curso','App\Http\Controllers\voyager\Alumnos_CursosController@index');
Route::get('/planificaevento','App\Http\Controllers\eventos_curso@index');

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

