@extends('layouts.layout')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Crear Nueva Categoría</h1>

    <form action="{{ route('categorias.store') }}" method="POST" class="max-w-md">
        @csrf

        <div class="mb-4">
            <label for="nombre" class="block font-medium">Nombre de la categoría:</label>
            <input type="text" name="nombre" id="nombre" class="w-full border px-3 py-2 rounded"
                   value="{{ old('nombre') }}" required>
            @error('nombre')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
            Guardar
        </button>
    </form>
@endsection
