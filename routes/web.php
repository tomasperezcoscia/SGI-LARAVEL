<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HorasPersonalController;
use App\Http\Controllers\PresupuestoController;
use App\Http\Controllers\ObraController;
use App\Http\Controllers\InsumoController;




Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('User', App\Http\Controllers\UserController::class);
Route::resource('Cliente', App\Http\Controllers\ClienteController::class);
Route::resource('CargasSociales', App\Http\Controllers\CargasSocialesController::class);
Route::resource('Energia', App\Http\Controllers\EnergiaController::class);
Route::resource('GastosBancarios', App\Http\Controllers\GastosBancariosController::class);
Route::resource('AusenciasPersonal', App\Http\Controllers\AusenciasPersonalController::class);
Route::resource('Gasto', App\Http\Controllers\GastoController::class);
Route::resource('HorasPersonal', App\Http\Controllers\HorasPersonalController::class);
Route::resource('Insumo', App\Http\Controllers\InsumoController::class);
Route::resource('OrdenesDeCompra', App\Http\Controllers\OrdenesDeCompraController::class);
Route::resource('Personal', App\Http\Controllers\PersonalController::class);
Route::resource('Proovedore', App\Http\Controllers\ProovedoreController::class);

Route::get('/gastos-bancarios/month/{mesAnio}', [App\Http\Controllers\GastosBancariosController::class, 'getGastosBancariosFromMonth'])->name('gastos-bancarios.month');
Route::get('/energia/month/{mesAnio}', [App\Http\Controllers\EnergiaController::class, 'getEnergiaFromMonth'])->name('energia.month');
Route::get('/horas-personal/month/{mesAnio}', [App\Http\Controllers\HorasPersonalController::class, 'getHorasPersonalFromMonth'])->name('horas-personal.month');
Route::get('/order-details/{id}', [App\Http\Controllers\HomeController::class, 'getOrderDetails'])->name('order-details');
Route::get('/consolidated-data/month/{mesAnio}', [App\Http\Controllers\HomeController::class, 'getConsolidatedDataFromMonth'])->name('consolidated-data.month');

Route::middleware(['auth', 'web'])->group(function () {
    Route::get('/gastos-bancarios/month/{mesAnio}', [App\Http\Controllers\GastosBancariosController::class, 'getGastosBancariosFromMonth'])->name('gastos-bancarios.month');
    Route::get('/energia/month/{mesAnio}', [App\Http\Controllers\EnergiaController::class, 'getEnergiaFromMonth'])->name('energia.month');
    Route::get('/horas-personal/month/{mesAnio}', [App\Http\Controllers\HorasPersonalController::class, 'getHorasPersonalFromMonth'])->name('horas-personal.month');
    Route::get('/order-details/{id}', [App\Http\Controllers\HomeController::class, 'getOrderDetails'])->name('order-details');
    Route::get('/consolidated-data/month/{mesAnio}', [App\Http\Controllers\HomeController::class, 'getConsolidatedDataFromMonth'])->name('consolidated-data.month');
});
