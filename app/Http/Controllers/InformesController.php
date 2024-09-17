<?php

namespace App\Http\Controllers;

abstract class Controller
{
    //
}

use Illuminate\Http\Request;

class InformesController extends Controller
{
    public function index()
    {
        return view('informes'); // Asegúrate de que esta vista exista
    }
}
