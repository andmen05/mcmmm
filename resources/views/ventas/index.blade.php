@extends('layouts.layout')

@section('content')
    <h1>Ventas</h1>
    <a href="{{ route('ventas.create') }}" class="button">Nueva venta</a>

    <ul>
        @foreach($ventas as $venta)
            <li>
                Cliente: {{ $venta->cliente->nombre }} |
                Fecha: {{ $venta->created_at ? $venta->created_at->format('d/m/Y') : 'N/A' }} |
                Total: ${{ number_format($venta->total, 0, ',', '.') }} |
                <!-- Botón para ver detalles de la venta -->
                <a href="{{ route('ventas.show', $venta->id) }}" class="btn btn-info btn-sm">Ver Detalles</a>
            </li>
        @endforeach
    </ul>
@endsection
