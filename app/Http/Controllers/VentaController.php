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
    // Mostrar todas las ventas
    public function index()
    {
        $ventas = Venta::with('cliente')->get();
        return view('ventas.index', compact('ventas'));
    }

    // Mostrar los detalles de una venta específica
    public function show(Venta $venta)


    {
        // Carga la relación 'cliente' y 'detalles.producto' asociados a la venta
        $venta->load('cliente', 'detalles.producto');

        // Devuelve la vista con los detalles de la venta
        return view('ventas.show', compact('venta'));
    }

    public function factura(Venta $venta)
{
    $venta->load('cliente', 'detalles.producto');

    $pdf = Pdf::loadView('ventas.factura', compact('venta'));
    return $pdf->download('factura_venta_'.$venta->id.'.pdf');
}


    // Mostrar el formulario de creación de una nueva venta
    public function create()
    {
        // Obtener todos los clientes y productos para el formulario
        $clientes = Cliente::all();
        $productos = Producto::all();
        return view('ventas.create', compact('clientes', 'productos'));
    }

    // Almacenar una nueva venta
    public function store(Request $request)
    {
        // Validar la entrada del formulario
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'producto_id' => 'required|array|min:1',
            'producto_id.*' => 'required|exists:productos,id',
            'cantidad.*' => 'required|integer|min:1',
            'precio_unitario.*' => 'required|numeric|min:0',
        ]);

        // Crear la venta
        $venta = Venta::create([
            'cliente_id' => $request->cliente_id,
            'total' => 0, // Este valor se actualizará después
        ]);

        $total = 0;

        // Recorrer los productos y calcular el total
        for ($i = 0; $i < count($request->producto_id); $i++) {
            $productoId = $request->producto_id[$i];
            $cantidad = $request->cantidad[$i];
            $precio = $request->precio_unitario[$i];

            $subtotal = $cantidad * $precio;
            $total += $subtotal;

            // Crear los detalles de la venta
            DetalleVenta::create([
                'venta_id' => $venta->id,
                'producto_id' => $productoId,
                'cantidad' => $cantidad,
                'precio_unitario' => $precio,
            ]);
        }

        // Actualizar el total de la venta
        $venta->update(['total' => $total]);

        // Redirigir a la vista de ventas con un mensaje de éxito
        return redirect()->route('ventas.index')->with('success', 'Venta registrada correctamente.');
    }
}
