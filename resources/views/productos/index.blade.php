@extends('layouts.layout')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Lista de Productos</h1>

    <div class="flex justify-between items-center mb-4">
        <a href="{{ route('productos.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
            Nuevo Producto

            <!-- Botón para Nueva Categoría -->
        <a href="{{ route('categorias.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
            Nueva Categoría

        </a>

        <form action="{{ route('productos.index') }}" method="GET" class="flex items-center gap-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar por nombre"
                class="border border-gray-300 rounded px-3 py-1">

            <select name="categoria_id" onchange="this.form.submit()"
                class="border border-gray-300 rounded px-3 py-1">
                <option value="">Todas las categorías</option>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}" {{ request('categoria_id') == $categoria->id ? 'selected' : '' }}>
                        {{ $categoria->nombre }}
                    </option>
                @endforeach
            </select>

            <button type="submit" class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-1 rounded">
                Buscar
            </button>
        </form>
    </div>

    @if (session('success'))
        <div class="bg-green-200 text-green-800 p-2 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full border-collapse border border-gray-300">
        <thead class="bg-gray-200">
            <tr>
                <th class="border px-4 py-2">Nombre</th>
                <th class="border px-4 py-2">Descripción</th>
                <th class="border px-4 py-2">Precio</th>
                <th class="border px-4 py-2">Stock</th>
                <th class="border px-4 py-2">Categoría</th>
                <th class="border px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($productos as $producto)
                <tr>
                    <td class="border px-4 py-2">{{ $producto->nombre }}</td>
                    <td class="border px-4 py-2">{{ $producto->descripcion }}</td>
                    <td class="border px-4 py-2">${{ number_format($producto->precio, 2) }}</td>
                    <td class="border px-4 py-2">{{ $producto->stock }}</td>
                    <td class="border px-4 py-2">{{ $producto->categoria->nombre ?? 'Sin categoría' }}</td>
                    <td class="border px-4 py-2 flex gap-2">
                        <a href="{{ route('productos.edit', $producto->id) }}" class="bg-yellow-400 hover:bg-yellow-500 text-white px-2 py-1 rounded">Editar</a>

                        <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este producto?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-4">No se encontraron productos.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $productos->links() }}
    </div>
@endsection
