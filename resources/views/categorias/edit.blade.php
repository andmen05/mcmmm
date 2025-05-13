@extends('layouts.layout')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Editar Categoría</h1>

    <form action="{{ route('categorias.update', $categoria->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block mb-1">Nombre:</label>
            <input type="text" name="nombre" value="{{ old('nombre', $categoria->nombre) }}" class="w-full border px-3 py-2 rounded" required>
        </div>

        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
            Actualizar
        </button>
        <a href="{{ route('categorias.index') }}" class="text-blue-500 ml-4">← Volver</a>
    </form>
@endsection
