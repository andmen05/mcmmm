<h1>Crear Venta</h1>
<form method="POST" action="{{ route('ventas.store') }}">
    @csrf
    <label>Cliente:</label><br>
    <select name="cliente_id">
        @foreach($clientes as $cliente)
            <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
        @endforeach
    </select><br>
    <input name="total" placeholder="Total" type="number" step="0.01"><br>
    <button type="submit">Guardar</button>
</form>
