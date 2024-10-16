<?php

namespace App\Http\Controllers;
abstract class Controller
{
    //
}

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\InformesController;


class InformesController extends Controller
{
    public function index()
    {
        // Obtener informes y unirlos con los clientes
        $informes = DB::table('informe')
            ->join('cliente', 'informe.idCliente', '=', 'cliente.idCliente')
            ->select('informe.*', 'cliente.Nombre')
            ->get();

        // Obtener clientes para el select del formulario
        $clientes = DB::table('cliente')->get();

        return view('informes', compact('informes', 'clientes'));
    }

    // Crear un nuevo informe
    public function create(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'fechaInfo' => 'required|date',
            'descripcion' => 'required|string|max:200',
            'idCliente' => 'required|exists:cliente,idCliente', // Asegurarse que el cliente exista
        ]);

        // Insertar el nuevo informe en la base de datos
        DB::table('informe')->insert([
            'fechaInfo' => $request->fechaInfo,
            'descripcion' => $request->descripcion,
            'idCliente' => $request->idCliente
        ]);

        // Redirigir de vuelta con un mensaje de éxito
        return back()->with('Correcto', 'Informe registrado correctamente');
    }
    

    public function update(Request $request, $id)
{
    // Validar los datos
    $request->validate([
        'fechaInfo' => 'required|date',
        'descripcion' => 'required|string|max:200',
        'idCliente' => 'required|exists:cliente,idCliente',
    ]);

    // Actualizar el informe en la base de datos
    DB::table('informe')->where('idInforme', $id)->update([
        'fechaInfo' => $request->fechaInfo,
        'descripcion' => $request->descripcion,
        'idCliente' => $request->idCliente,
    ]);

    // Redirigir con un mensaje de éxito
    return back()->with('Correcto', 'Informe actualizado correctamente');
}

public function destroy($id)
{
    // Eliminar el informe
    DB::table('informe')->where('idInforme', $id)->delete();

    // Redirigir con un mensaje de éxito
    return back()->with('Correcto', 'Informe eliminado correctamente');
}

}
