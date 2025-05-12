@extends('layouts.layout')

@section('content')
    <h1 class="text-2xl font-bold mb-4">
        {{ isset($producto) ? 'Editar Producto' : 'Crear Producto' }}
    </h1>

    <form action="{{ isset($producto) ? route('productos.update', $producto->id) : route('productos.store') }}" method="POST" class="space-y-4">
        @csrf
        @if(isset($producto))
            @method('PUT')
        @endif

        <div>
            <label for="nombre" class="block font-medium">Nombre</label>
            <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $producto->nombre ?? '') }}"
                   class="w-full border border-gray-300 px-4 py-2 rounded" required>
            @error('nombre') <small class="text-red-500">{{ $message }}</small> @enderror
        </div>

        <div>
            <label for="descripcion" class="block font-medium">Descripción</label>
            <input type="text" name="descripcion" id="descripcion" value="{{ old('descripcion', $producto->descripcion ?? '') }}"
                   class="w-full border border-gray-300 px-4 py-2 rounded" required>
            @error('descripcion') <small class="text-red-500">{{ $message }}</small> @enderror
        </div>

        <div>
            <label for="precio" class="block font-medium">Precio</label>
            <input type="number" name="precio" id="precio" step="0.01" min="0" value="{{ old('precio', $producto->precio ?? '') }}"
                   class="w-full border border-gray-300 px-4 py-2 rounded" required>
            @error('precio') <small class="text-red-500">{{ $message }}</small> @enderror
        </div>

        <div>
            <label for="stock" class="block font-medium">Stock</label>
            <input type="number" name="stock" id="stock" min="0" value="{{ old('stock', $producto->stock ?? '') }}"
                   class="w-full border border-gray-300 px-4 py-2 rounded" required>
            @error('stock') <small class="text-red-500">{{ $message }}</small> @enderror
        </div>

        <div>
            <label for="categoria_id" class="block font-medium">Categoría</label>
            <select name="categoria_id" id="categoria_id" class="w-full border border-gray-300 px-4 py-2 rounded" required>
                <option value="">Seleccione una categoría</option>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}"
                        {{ old('categoria_id', $producto->categoria_id ?? '') == $categoria->id ? 'selected' : '' }}>
                        {{ $categoria->nombre }}
                    </option>
                @endforeach
            </select>
            @error('categoria_id') <small class="text-red-500">{{ $message }}</small> @enderror
        </div>

        <div>
            <button type="submit"
                    class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                {{ isset($producto) ? 'Actualizar' : 'Crear' }}
            </button>
        </div>
    </form>
@endsection
