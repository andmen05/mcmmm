@extends('layouts.layout')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Categorías</h1>

    <a href="{{ route('categorias.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">
        Nueva Categoría
    </a>

    @if (session('success'))
        <div class="bg-green-200 text-green-800 p-2 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full border-collapse border border-gray-300">
        <thead class="bg-gray-200">
            <tr>
                <th class="border px-4 py-2">ID</th>
                <th class="border px-4 py-2">Nombre</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categorias as $categoria)
                <tr>
                    <td class="border px-4 py-2">{{ $categoria->id }}</td>
                    <td class="border px-4 py-2">{{ $categoria->nombre }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
