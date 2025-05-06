@extends('layouts.layout')


@section('content')
    <h1>Ventas</h1>
    <a href="{{ route('ventas.create') }}" class="button">Nueva venta</a>
    <ul>
        @foreach($ventas as $venta)
            <li>
                Cliente: {{ $venta->cliente->nombre }} |
                Fecha: Fecha: Fecha: {{ $venta->created_at ? $venta->created_at->format('d/m/Y') : 'N/A' }}                |
                Total: ${{ $venta->total }}
            </li>
        @endforeach
    </ul>

