<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\DetalleVenta;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class VentaController extends Controller
{
    public function index()
    {
        $ventas = Venta::with('cliente')->get();
        return view('ventas.index', compact('ventas'));
    }

    public function show(Venta $venta)
    {
        $venta->load('cliente', 'detalles.producto');
        return view('ventas.show', compact('venta'));
    }

    public function factura(Venta $venta)
    {
        $venta->load('cliente', 'detalles.producto');
        $pdf = Pdf::loadView('ventas.factura', compact('venta'));
        return $pdf->download('factura_venta_'.$venta->id.'.pdf');
    }

    public function create()
    {
        $clientes = Cliente::all();
        $productos = Producto::all();
        return view('ventas.create', compact('clientes', 'productos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'producto_id' => 'required|array|min:1',
            'producto_id.*' => 'required|exists:productos,id',
            'cantidad.*' => 'required|integer|min:1',
            'precio_unitario.*' => 'required|numeric|min:0',
        ]);

        // Verificar stock
        for ($i = 0; $i < count($request->producto_id); $i++) {
            $productoId = $request->producto_id[$i];
            $cantidad = $request->cantidad[$i];
            $producto = Producto::find($productoId);

            if (!$producto || $producto->stock < $cantidad) {
                return redirect()->back()->withInput()->with('error', "Stock insuficiente para el producto: {$producto->nombre}");
            }
        }

        // Crear venta
        $venta = Venta::create([
            'cliente_id' => $request->cliente_id,
            'total' => 0,
        ]);

        $total = 0;

        for ($i = 0; $i < count($request->producto_id); $i++) {
            $productoId = $request->producto_id[$i];
            $cantidad = $request->cantidad[$i];
            $precio = $request->precio_unitario[$i];

            $subtotal = $cantidad * $precio;
            $total += $subtotal;

            DetalleVenta::create([
                'venta_id' => $venta->id,
                'producto_id' => $productoId,
                'cantidad' => $cantidad,
                'precio_unitario' => $precio,
            ]);

            // Descontar del stock
            $producto = Producto::find($productoId);
            $producto->stock -= $cantidad;
            $producto->save();
        }

        $venta->update(['total' => $total]);

        return redirect()->route('ventas.index')->with('success', 'Venta registrada correctamente.');
    }
}
