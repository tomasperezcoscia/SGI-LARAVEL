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
Route::resource('AusenciasPersonal', App\Http\Controllers\AusenciasPersonalController::class);
Route::resource('Gasto', App\Http\Controllers\GastoController::class);
Route::resource('HorasPersonal', App\Http\Controllers\HorasPersonalController::class);
Route::resource('Insumo', App\Http\Controllers\InsumoController::class);
Route::resource('InsumosParaObra', App\Http\Controllers\InsumosParaObraController::class);
Route::resource('OrdenesDeCompra', App\Http\Controllers\OrdenesDeCompraController::class);
Route::resource('Personal', App\Http\Controllers\PersonalController::class);
Route::resource('Proovedore', App\Http\Controllers\ProovedoreController::class);
Route::resource('Tarea', App\Http\Controllers\TareaController::class);
Route::resource('TipoDeObra', App\Http\Controllers\TipoDeObraController::class);
Route::resource('presupuestos', PresupuestoController::class);
Route::resource('obras', ObraController::class)->except(['index']);

Route::get('obras/create/{presupuesto_id}', [ObraController::class, 'create'])->name('obras.create');
Route::get('/insumos/list', [InsumoController::class, 'list'])->name('insumos.list');
Route::get('/presupuestos/{id}/compare', [PresupuestoController::class, 'compare'])->name('presupuestos.compare');


// Custom route for partialStore method
Route::post('/HorasPersonal/partialStore', [HorasPersonalController::class, 'partialStore'])->name('HorasPersonal.partialStore');
