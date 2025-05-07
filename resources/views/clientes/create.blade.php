@extends('layouts.layout')

<form action="{{ route('clientes.store') }}" method="POST">
    @csrf
    <div>
        <label>Nombre:</label>
        <input type="text" name="nombre" required>
    </div>
    <div>
        <label>Email:</label>
        <input type="email" name="email" required>
    </div>
    <div>
        <label>Teléfono:</label>
        <input type="text" name="telefono" required>
    </div>
    <button type="submit">Guardar</button>
</form>


