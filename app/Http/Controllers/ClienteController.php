<?php

namespace App\Http\Controllers;

abstract class Controller
{
    //
}

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;

class ClienteController extends Controller
{
    public function index()
    {
        $datos=DB::select(" select * from cliente ");
        return view('cliente')->with("datos", $datos);
    }

    public function create(Request $request){
        try {
            $sql=DB::insert(" insert into cliente(Nombre,Direccion,entidad,RUC_DNI)values(?,?,?,?) ", 
        [
        
            $request->txtNombre,
            $request->txtDireccion,
            $request->txtentidad,
            $request->txtRUC_DNI,

        ]);
        } catch (\Throwable $th) {
            $sql = 0;
        }
        if ($sql == true) {
            return back()->with("Correcto","Cliente registrado correctamente");
           
        } else {
            return back()->with("Incorrecto","Error al registrar");
        }
        

    }

    public function update(Request $request){
        try {
            $sql=DB::update(" update cliente set Nombre=?, Direccion=?, entidad=?, RUC_DNI=? where idCliente=?", [
          
            $request->txtNombre,
            $request->txtDireccion,
            $request->txtentidad,
            $request->txtRUC_DNI,
            $request->txtidCliente,
          

            ]);
            if ($sql==0) {
                $sql=1;
            }
        } catch (\Throwable $th) {
            $sql=0;
        }
        if ($sql == true) {
            return back()->with("Correcto","Cliente modificado correctamente");
           
        } else {
            return back()->with("Incorrecto","Error al modificar");
        }


    }
        public function delete ($id){
            try {
                $sql=DB::delete(" delete from cliente where idCliente=$id ");
            } catch (\Throwable $th) {
                $sql = 0;
            }
            if ($sql == true) {
                return back()->with("Correcto","Cliente eliminado correctamente");
               
            } else {
                return back()->with("Incorrecto","Error al eliminar");
            }


        }
}

