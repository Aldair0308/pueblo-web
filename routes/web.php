<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrdenarController; // Asegúrate de importar el controlador OrdenarController
use App\Http\Controllers\MesaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\RondaController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('ordenar/{numerodemesa}', [OrdenarController::class, 'ordenarPorNumeroMesa'])->name('ordenar.por-numero-mesa');

Route::resource('mesas', MesaController::class);

Route::resource('productos', ProductoController::class);

Route::resource('rondas', RondaController::class);