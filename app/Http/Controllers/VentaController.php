<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Cliente;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    public function index() {
        $ventas = Venta::with('cliente')->get();
        return view('ventas.index', compact('ventas'));
    }

    public function create() {
        $clientes = Cliente::all();
        return view('ventas.create', compact('clientes'));
    }

    public function store(Request $request) {
        Venta::create($request->all());
        return redirect()->route('ventas.index');
    }
}
