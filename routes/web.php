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
Route::get('/dashboard2', [Dashboard2Controller::class, 'index'])->name('dashboard2');
Route::get('/cliente', [ClienteController::class, 'index']);
Route::get('/factura', [FacturaController::class, 'index']);
Route::get('/informes', [informesController::class, 'index']);
Route::get('/presupuesto', [PresupuestoController::class, 'index']);

//ruta agregar nuevo cliente
Route::post("/registrar-cliente", [ClienteController::class, "create"])->name("crud.create");
//ruta modificar cliente
Route::post("/modificar-cliente", [ClienteController::class, "update"])->name("crud.update");
//ruta eliminar cliente 
Route::get("/eliminar-cliente-{id}", [ClienteController::class, "delete"])->name("crud.delete");
