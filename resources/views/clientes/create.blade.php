@extends('layouts.layout')

@section('content')
    <h1>Crear Cliente</h1>
    <form method="POST" action="{{ route('clientes.store') }}">
        @csrf
        <input name="nombre" placeholder="Nombre" required>
        <input name="email" placeholder="Email" required>
        <input name="telefono" placeholder="Teléfono" required>
        <button type="submit">Guardar</button>
    </form>
@endsection

