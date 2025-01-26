<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use App\Models\Smartphone;
use Illuminate\Http\Request;

class FacturaController extends Controller
{
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

        $montoTotal = $smartphone->precio * $cantidad;

        // Crear la factura
        $factura = Factura::create([
            'cliente' => $cliente,
            'smartphone_id' => $smartphoneId,
            'cantidad' => $cantidad,
            'monto_total' => $montoTotal
        ]);

        return response()->json($factura, 201);
    }
}
