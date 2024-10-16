<?php

namespace App\Http\Controllers;
abstract class Controller
{
    //
}
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller; 

class PresupuestoController extends Controller
{
    public function index()
    {
        // Obtener presupuestos y sus respectivos clientes
        $presupuestos = DB::table('presupuesto')
            ->join('cliente', 'presupuesto.idCliente', '=', 'cliente.idCliente')
            ->select('presupuesto.*', 'cliente.Nombre')
            ->get();

        // Obtener clientes para el modal de creación
        $clientes = DB::table('cliente')->get();

        return view('presupuesto', compact('presupuestos', 'clientes'));
    }

    public function create(Request $request)
    {
        // Insertar un nuevo presupuesto
        $presupuestoId = DB::table('presupuesto')->insertGetId([
            'fechaPresu' => $request->fechaPresu,
            'descripcionPres' => $request->descripcionPres,
            'idCliente' => $request->idCliente,
        ]);

        // Insertar los detalles del presupuesto
        foreach ($request->detalles as $detalle) {
            DB::table('detallepresu')->insert([
                'descriptabla' => $detalle['descriptabla'],
                'unidadMed' => $detalle['unidadMed'],
                'cantidad' => $detalle['cantidad'],
                'precioUnitario' => $detalle['precioUnitario'],
                'descuentoPres' => $detalle['descuentoPres'],
                'TotalPres' => $detalle['TotalPres'],
                'nota' => $detalle['nota'],
                'garantia' => $detalle['garantia'],
                'idPresu' => $presupuestoId,
            ]);
        }

        return back()->with('Correcto', 'Presupuesto registrado correctamente con detalles');
    }

    public function detalles($idPresu)
    {
        // Obtener presupuesto específico y sus detalles
        $presupuesto = DB::table('presupuesto')
            ->join('cliente', 'presupuesto.idCliente', '=', 'cliente.idCliente')
            ->where('presupuesto.idPresu', $idPresu)
            ->select('presupuesto.*', 'cliente.Nombre')
            ->first();
    
        if (!$presupuesto) {
            return abort(404, 'Presupuesto no encontrado.');
        }
    
        $detalles = DB::table('detallepresu')
            ->where('idPresu', $idPresu)
            ->get();
    
        return view('presupuesto_detalles_modal', compact('presupuesto', 'detalles'));
    }
}
