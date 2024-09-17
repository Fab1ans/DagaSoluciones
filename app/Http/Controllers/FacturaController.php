<?php

namespace App\Http\Controllers;

abstract class Controller
{
    //
}

use Illuminate\Http\Request;

class FacturaController extends Controller
{
    public function index()
    {
        return view('factura'); // Asegúrate de que esta vista exista
    }
}
