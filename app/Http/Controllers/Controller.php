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

        // Este es un ejemplo simple sin lógica de autenticación real:
        if ($credentials['email'] == 'johndoe@email.com' && $credentials['password'] == '123456') {
            // Si las credenciales son correctas, redirige al dashboard
            return redirect()->route('dashboard');
        } else {
            // Si las credenciales son incorrectas, redirige de vuelta al login con un error
            return redirect()->route('principal')->withErrors(['message' => 'Credenciales incorrectas']);
        }
    }
}