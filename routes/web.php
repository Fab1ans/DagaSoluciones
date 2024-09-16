<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Ruta para la vista de inicio de sesión
Route::get('/', function () {
    return view('principal'); // Aquí 'principal' es la vista de login
})->name('principal');

// Ruta para manejar el envío del formulario de login
Route::post('/', [AuthController::class, '/'])->name('principal.submit');

// Ruta para el dashboard
Route::get('/dashboard', function () {
    return view('dashboard'); // Aquí 'dashboard' es la vista del dashboard
})->name('dashboard');