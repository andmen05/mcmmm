@extends('layouts.layout')<!-- Esto indica que esta vista extiende el layout ubicado en 'resources/views/layouts/layout.blade.php' -->

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Registrar nueva venta</h2>

    <form action="{{ route('ventas.store') }}" method="POST">
        @csrf

        {{-- Cliente --}}
        <div class="mb-3">
            <label for="cliente_id" class="form-label">Cliente</label>
            <select name="cliente_id" id="cliente_id" class="form-select" required>
                <option value="" disabled selected>Selecciona un cliente</option>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                @endforeach
            </select>
        </div>

        {{-- Productos --}}
        <div id="productos" class="mb-3">
            <label for="producto_id" class="form-label">Producto</label>
            <select name="productos[0][producto_id]" id="producto_id" class="form-select" required>
                <option value="" disabled selected>Selecciona un producto</option>
                @foreach($productos as $producto)
                    <option value="{{ $producto->id }}">
                        {{ $producto->nombre }} - ${{ number_format($producto->precio, 0, ',', '.') }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Cantidad --}}
        <div class="mb-3">
            <label for="cantidad" class="form-label">Cantidad</label>
            <input type="number" name="productos[0][cantidad]" id="cantidad" class="form-control" min="1" required>
        </div>

        {{-- Precio --}}
        <div class="mb-3">
            <label for="precio" class="form-label">Precio</label>
            <input type="number" name="productos[0][precio]" id="precio" class="form-control" step="0.01" required>
        </div>

        <button type="submit" class="btn btn-primary">Registrar Venta</button>
        <a href="{{ route('ventas.index') }}" class="btn btn-secondary ms-2">Cancelar</a>
    </form>
</div>
@endsection

