@extends('layouts.layout')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Registrar nueva venta</h2>

    {{-- Mostrar mensaje de error de stock --}}
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

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

        {{-- Productos dinámicos --}}
        <div id="productos-container">
            <div class="producto-item row mb-3">
                <div class="col-md-4">
                    <label class="form-label">Producto</label>
                    <select name="producto_id[]" class="form-select" required>
                        <option value="" disabled selected>Selecciona un producto</option>
                        @foreach($productos as $producto)
                            <option value="{{ $producto->id }}">
                                {{ $producto->nombre }} - ${{ number_format($producto->precio, 0, ',', '.') }} - Stock: {{ $producto->stock }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Cantidad</label>
                    <input type="number" name="cantidad[]" class="form-control" min="1" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Precio Unitario</label>
                    <input type="number" name="precio_unitario[]" class="form-control" step="0.01" required>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="button" class="btn btn-danger btn-remove">X</button>
                </div>
            </div>
        </div>

        <button type="button" class="btn btn-success mb-3" id="agregar-producto">Agregar otro producto</button>

        <br>
        <button type="submit" class="btn btn-primary">Registrar Venta</button>
        <a href="{{ route('ventas.index') }}" class="btn btn-secondary ms-2">Cancelar</a>
    </form>
</div>

{{-- Script para clonar campos --}}
<script>
document.getElementById('agregar-producto').addEventListener('click', function () {
    const container = document.getElementById('productos-container');
    const firstItem = container.querySelector('.producto-item');
    const newItem = firstItem.cloneNode(true);

    newItem.querySelectorAll('input').forEach(input => input.value = '');
    newItem.querySelector('select').selectedIndex = 0;

    container.appendChild(newItem);
});

document.addEventListener('click', function (e) {
    if (e.target && e.target.classList.contains('btn-remove')) {
        const container = document.getElementById('productos-container');
        if (container.querySelectorAll('.producto-item').length > 1) {
            e.target.closest('.producto-item').remove();
        }
    }
});
</script>
@endsection
