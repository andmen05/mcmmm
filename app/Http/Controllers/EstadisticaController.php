<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\DetalleVenta;
use App\Models\Producto;
use App\Models\Cliente;
use Illuminate\Support\Facades\DB;

class EstadisticaController extends Controller
{
    public function index()
    {
        $totalVentas = Venta::count();
        $totalIngresos = Venta::sum('total');

        // Producto más vendido
        $productoMasVendido = DetalleVenta::selectRaw('producto_id, SUM(cantidad) as total_vendido')
            ->groupBy('producto_id')
            ->orderByDesc('total_vendido')
            ->with('producto')
            ->first();

        // Cliente con más compras
        $clienteTop = Venta::selectRaw('cliente_id, SUM(total) as total_comprado')
            ->groupBy('cliente_id')
            ->orderByDesc('total_comprado')
            ->with('cliente')
            ->first();

        // Ventas por producto para la gráfica
        $productos = Producto::with('detalles')->get();
        $ventasPorProducto = [];

        foreach ($productos as $producto) {
            $ventasPorProducto[] = [
                'nombre' => $producto->nombre,
                'ventas' => $producto->detalles ? $producto->detalles->sum('cantidad') : 0
            ];
        }

        // Ventas por mes para gráfica (últimos 6 meses)
        $ventasPorMes = Venta::selectRaw("DATE_FORMAT(created_at, '%Y-%m') as mes, SUM(total) as total")
            ->groupBy('mes')
            ->orderBy('mes')
            ->get();

        return view('estadisticas.index', compact(
            'totalVentas',
            'totalIngresos',
            'productoMasVendido',
            'clienteTop',
            'ventasPorProducto',
            'ventasPorMes'
        ));
    }
}
