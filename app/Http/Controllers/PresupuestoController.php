<?php

namespace App\Http\Controllers;

abstract class Controller
{
    //
}

use Illuminate\Http\Request;

class PresupuestoController extends Controller
{
    public function index()
    {
        return view('presupuesto');
    }
}
