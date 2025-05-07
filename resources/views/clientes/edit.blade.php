@extends('layouts.layout')

@section('content')
    <h1>Editar Cliente</h1>

    <form action="{{ route('clientes.update', $cliente->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label>Nombre:</label>
            <input type="text" name="nombre" value="{{ $cliente->nombre }}" required>
        </div>

        <div>
            <label>Email:</label>
            <input type="email" name="email" value="{{ $cliente->email }}" required>
        </div>

        <div>
            <label>Teléfono:</label>
            <input type="text" name="telefono" value="{{ $cliente->telefono }}" required>
        </div>

        <button type="submit">Actualizar</button>
    </form>

    <br>
    <a href="{{ route('clientes.index') }}">Volver a la lista</a>
@endsection
