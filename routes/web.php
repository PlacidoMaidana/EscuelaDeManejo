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
Route::get('/calendario/{idAlumnoCurso}','App\Http\Controllers\CalendarioController@index');
Route::post('/calendario/agregar','App\Http\Controllers\CalendarioController@store');
Route::post('/calendario/editar/{id}','App\Http\Controllers\CalendarioController@edit');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

