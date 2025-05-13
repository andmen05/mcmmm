@extends('layouts.layout')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Categorías</h1>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="{{ route('categorias.create') }}" class="btn btn-primary">
            Nueva Categoría
        </a>
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
                <th class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categorias as $categoria)
                <tr>
                    <td>{{ $categoria->nombre }}</td>
                    <td class="text-center d-flex justify-content-center gap-2">
                        <a href="{{ route('categorias.edit', $categoria->id) }}" class="btn btn-warning btn-sm">Editar</a>

                        <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST" onsubmit="return confirm('¿Deseas eliminar esta categoría?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" class="text-center">No hay categorías registradas.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
