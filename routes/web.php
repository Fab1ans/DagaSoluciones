<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\PresupuestoController;
use App\Http\Controllers\InformesController;
use App\Http\Controllers\Dashboard2Controller;


Route::get('/', function () {
    return view('principal'); 
})->name('principal');


Route::post('/', [AuthController::class, 'login'])->name('principal.submit');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard2', [Dashboard2Controller::class, 'index'])->name('dashboard2');
    Route::get('/cliente', [ClienteController::class, 'index']);
    Route::get('/factura', [FacturaController::class, 'index']);
    Route::get('/informes', [InformesController::class, 'index']);
    Route::get('/presupuesto', [PresupuestoController::class, 'index']);
});

//ruta para crear presupuesto
Route::post('/presupuesto/create', [PresupuestoController::class, 'create'])->name('presupuestos.create');
//ruta  para mostrar detalle presupuesto
Route::get('/presupuesto/detalles/{idPresu}', [PresupuestoController::class, 'detalles'])->name('presupuestos.detalles');

//ruta agregar nuevo cliente
Route::post("/registrar-cliente", [ClienteController::class, "create"])->name("crud.create");
//ruta modificar cliente
Route::post("/modificar-cliente", [ClienteController::class, "update"])->name("crud.update");
//ruta eliminar cliente 
Route::get("/eliminar-cliente-{id}", [ClienteController::class, "delete"])->name("crud.delete");


// Ruta para la vista de informes
Route::get('/informes', [InformesController::class, 'index'])->name('informes.index');
Route::post('/informes/create', [InformesController::class, 'create'])->name('informes.create');
Route::post('/informes/update/{id}', [InformesController::class, 'update'])->name('informes.update');
Route::post('/informes/delete/{id}', [InformesController::class, 'destroy'])->name('informes.destroy');



Route::post('/logout', [AuthController::class, 'logout'])->name('logout');