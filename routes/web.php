<?php

use Illuminate\Support\Facades\Route;

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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::prefix('administracion')->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

    Auth::routes();

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('User', App\Http\Controllers\UserController::class);
    Route::resource('Cliente', App\Http\Controllers\ClienteController::class);
    Route::resource('AusenciasPersonal', App\Http\Controllers\AusenciasPersonalController::class);
    Route::resource('Gasto', App\Http\Controllers\GastoController::class);
    Route::resource('HorasPersonal', App\Http\Controllers\HorasPersonalController::class);
    Route::resource('Insumo', App\Http\Controllers\InsumoController::class);
    Route::resource('InsumosParaObra', App\Http\Controllers\InsumosParaObraController::class);
    Route::resource('Obra', App\Http\Controllers\ObraController::class);
    Route::resource('OrdenesDeCompra', App\Http\Controllers\OrdenesDeCompraController::class);
    Route::resource('Personal', App\Http\Controllers\PersonalController::class);
    Route::resource('PresupuestoDeObra', App\Http\Controllers\PresupuestoDeObraController::class);
    Route::resource('Proovedore', App\Http\Controllers\ProovedoreController::class);
    Route::resource('Tarea', App\Http\Controllers\TareaController::class);
    Route::resource('TipoDeObra', App\Http\Controllers\TipoDeObraController::class);
});






