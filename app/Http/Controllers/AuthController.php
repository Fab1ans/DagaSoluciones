<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
abstract class Controller
{
    //
}

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validar los datos del formulario
        $credentials = $request->only('email', 'password');

        // Validar si las credenciales son correctas
        if ($credentials['email'] === 'johndoe@email.com' && $credentials['password'] === '123456') {
            // Si las credenciales son correctas, redirige al dashboard
            return redirect()->route('dashboard2');
        } else {
            // Si las credenciales son incorrectas, redirige de vuelta al login con un mensaje de error
            return redirect()->route('principal')->withErrors(['message' => 'Credenciales incorrectas']);
        }
    }
}