@extends('layouts.layout')

@section('content')
<div class="container mt-4">
    <h3>Detalle de Venta #{{ $venta->id }}</h3>
    <p><strong>Cliente:</strong> {{ $venta->cliente->nombre }}</p>
    <p><strong>Total:</strong> ${{ number_format($venta->total, 0, ',', '.') }}</p>

    <h5>Productos comprados:</h5>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio unitario</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($venta->detalles as $detalle)
                <tr>
                    <td>{{ $detalle->producto->nombre }}</td>
                    <td>{{ $detalle->cantidad }}</td>
                    <td>${{ number_format($detalle->precio_unitario, 0, ',', '.') }}</td>
                    <td>${{ number_format($detalle->cantidad * $detalle->precio_unitario, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('ventas.index') }}" class="btn btn-secondary mt-3">Volver</a>
    <a href="{{ route('ventas.factura', $venta->id) }}" class="btn btn-primary btn-sm">Descargar Factura PDF</a>

</div>
@endsection
