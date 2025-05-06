@extends('layouts.layout')

@section('content')
    <h1>Crear Producto</h1>
    <form method="POST" action="{{ route('productos.store') }}">
        @csrf
        <input name="nombre" placeholder="Nombre" required>
        <input name="descripcion" placeholder="Descripción" required>
        <input name="precio" placeholder="Precio" type="number" step="0.01" required>
        <button type="submit">Guardar</button>
    </form>
@endsection
