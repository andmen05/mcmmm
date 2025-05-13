@extends('layouts.layout')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Lista de Productos</h1>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex gap-2">
            <a href="{{ route('productos.create') }}" class="btn btn-primary">
                Nuevo Producto
            </a>
            <a href="{{ route('categorias.create') }}" class="btn btn-secondary">
                Nueva Categoría
            </a>
        </div>

        <form action="{{ route('productos.index') }}" method="GET" class="d-flex align-items-center gap-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar por nombre"
                class="form-control">

            <select name="categoria_id" onchange="this.form.submit()" class="form-select">
                <option value="">Todas las categorías</option>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}" {{ request('categoria_id') == $categoria->id ? 'selected' : '' }}>
                        {{ $categoria->nombre }}
                    </option>
                @endforeach
            </select>

            <button type="submit" class="btn btn-dark">
                Buscar
            </button>
        </form>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Categoría</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($productos as $producto)
                <tr>
                    <td>{{ $producto->nombre }}</td>
                    <td>{{ $producto->descripcion }}</td>
                    <td>${{ number_format($producto->precio, 2) }}</td>
                    <td>{{ $producto->stock }}</td>
                    <td>{{ $producto->categoria->nombre ?? 'Sin categoría' }}</td>
                    <td class="d-flex gap-2">
                        <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este producto?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No se encontraron productos.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $productos->links() }}
    </div>
@endsection
