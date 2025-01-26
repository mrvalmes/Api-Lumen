<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use App\Models\Smartphone;
use Illuminate\Http\Request;

class FacturaController extends Controller
{
    // GET /api/facturas
    public function index()
    {
        return response()->json(Factura::all(), 200);
    }
    // POST Guardar una facturas
    public function store(Request $request)
    {
        // Ejemplo: calculamos monto total = precio * cantidad
        $smartphoneId = $request->input('smartphone_id');
        $cantidad = (int) $request->input('cantidad', 1);
        $cliente = $request->input('cliente', 'Sin nombre');

        // Verificar smartphone
        $smartphone = Smartphone::find($smartphoneId);
        if (!$smartphone) {
            return response()->json(['error' => 'Smartphone no encontrado'], 404);
        }

        $montoTotal = $smartphone->Price * $cantidad;

        // Crear la factura
        $factura = Factura::create([
            'cliente' => $cliente,
            'smartphone_id' => $smartphoneId,
            'cantidad' => $cantidad,
            'monto_total' => $montoTotal
        ]);

        return response()->json($factura, 201);
    }
    // GET /api/facturas/{id}
    public function show($id)
    {
        $factura = Factura::find($id);
        if (!$factura) {
            return response()->json(['error' => 'Factura no encontrada'], 404);
        }
        return response()->json($factura, 200);
    }
}
