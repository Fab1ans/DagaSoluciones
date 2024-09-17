<?php

namespace App\Http\Controllers;

abstract class Controller
{
    //
}

use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        return view('cliente'); 
    }
}
