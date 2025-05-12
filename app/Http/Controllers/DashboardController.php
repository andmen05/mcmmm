<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Producto;
use App\Models\Cliente;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Total de productos
        $totalProductos = Producto::count();

        // Total de ventas del día
        $ventasDelDia = Venta::whereDate('created_at', today())->sum('total');

        // Cliente más activo (el que más compras ha hecho)
        $clienteMasActivo = Cliente::withCount('ventas')
            ->orderBy('ventas_count', 'desc')
            ->first();
        $clienteMasActivo = $clienteMasActivo ? $clienteMasActivo->nombre : 'N/A';

        // Productos con menos stock
        $productosConMenosStock = Producto::orderBy('stock')->take(5)->get();

        return view('dashboard', compact('totalProductos', 'ventasDelDia', 'clienteMasActivo', 'productosConMenosStock'));
    }
}
