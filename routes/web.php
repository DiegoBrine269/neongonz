<?php

use App\Http\Controllers\HomeController;
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


Route::get('/', 'App\Http\Controllers\HomeController@index');
Route::get('/home', 'App\Http\Controllers\HomeController@index');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth');
Route::get('/servicios/nuevo', [App\Http\Controllers\ServicesController::class, 'nuevo'])->middleware('auth');
Route::post('/servicios/nuevo', [App\Http\Controllers\ServicesController::class, 'nuevo'])->middleware('auth');

Route::get('/servicios', [App\Http\Controllers\ServicesController::class, 'index'])->middleware('auth');
Route::post('/servicios', [App\Http\Controllers\ServicesController::class, 'index'])->middleware('auth');

Route::get('/servicios/servicio', [App\Http\Controllers\ServicesController::class, 'consultar'])->middleware('auth');
Route::post('/servicios/servicio', [App\Http\Controllers\ServicesController::class, 'consultar'])->middleware('auth');
Route::get('/servicios/eliminar', [App\Http\Controllers\ServicesController::class, 'eliminar'])->middleware('auth');

Route::get('/agencias', [App\Http\Controllers\AgenciesController::class, 'index'])->middleware('auth');
Route::post('/agencias', [App\Http\Controllers\AgenciesController::class, 'index'])->middleware('auth');

Route::get('/agencias/nueva', [App\Http\Controllers\AgenciesController::class, 'nueva'])->middleware('auth');
Route::post('/agencias/nueva', [App\Http\Controllers\AgenciesController::class, 'nueva'])->middleware('auth');

Route::get('/agencias/editar', [App\Http\Controllers\AgenciesController::class, 'editar'])->middleware('auth');
Route::post('/agencias/editar', [App\Http\Controllers\AgenciesController::class, 'editar'])->middleware('auth');

Route::get('/agencias/eliminar', [App\Http\Controllers\AgenciesController::class, 'eliminar'])->middleware('auth');


Route::get('/cotizaciones/generar', [App\Http\Controllers\CotizacionesController::class, 'index'])->middleware('auth');
Route::post('/cotizaciones/generar', [App\Http\Controllers\CotizacionesController::class, 'index'])->middleware('auth');