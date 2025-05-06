<h1>Crear Producto</h1>
<form method="POST" action="{{ route('productos.store') }}">
    @csrf
    <input name="nombre" placeholder="Nombre"><br>
    <input name="descripcion" placeholder="Descripción"><br>
    <input name="precio" placeholder="Precio" type="number" step="0.01"><br>
    <button type="submit">Guardar</button>
</form>
