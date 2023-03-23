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
Route::post('/planificaevento/agregar','App\Http\Controllers\eventos_curso@store');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

