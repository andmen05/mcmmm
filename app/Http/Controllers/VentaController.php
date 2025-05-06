<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\DetalleVenta;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    // Mostrar todas las ventas
    public function index()
    {
        $ventas = Venta::with('cliente')->get(); // Obtener ventas con cliente
        return view('ventas.index', compact('ventas'));
    }

    // Mostrar el formulario de creación
    public function create()
    {
        $clientes = Cliente::all();
        $productos = Producto::all(); // Obtener productos disponibles
        return view('ventas.create', compact('clientes', 'productos'));
    }

    // Almacenar una nueva venta
    public function store(Request $request)
    {
        // Validar campos (opcionalmente puedes agregar más validaciones)
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'productos.*.producto_id' => 'required|exists:productos,id',
            'productos.*.cantidad' => 'required|integer|min:1',
            'productos.*.precio' => 'required|numeric|min:0',
        ]);

        // Crear la venta sin total aún
        $venta = Venta::create([
            'cliente_id' => $request->cliente_id,
            'total' => 0, // provisional
        ]);

        $total = 0;

        // Guardar detalles de la venta
        foreach ($request->productos as $item) {
            $subtotal = $item['cantidad'] * $item['precio'];
            $total += $subtotal;

            DetalleVenta::create([
                'venta_id' => $venta->id,
                'producto_id' => $item['producto_id'],
                'cantidad' => $item['cantidad'],
                'precio_unitario' => $item['precio'],
            ]);
        }

        // Actualizar el total de la venta
        $venta->update(['total' => $total]);

        return redirect()->route('ventas.index')->with('success', 'Venta registrada correctamente');
    }
}

