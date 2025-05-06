@extends('layouts.layout')

@section('content')
    <h1>Productos</h1>
    <a href="{{ route('productos.create') }}" class="button">Nuevo producto</a>
    <ul>
        @foreach($productos as $producto)
            <li>{{ $producto->nombre }} - ${{ $producto->precio }}</li>
        @endforeach
    </ul>
@endsection
