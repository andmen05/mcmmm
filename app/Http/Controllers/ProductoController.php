<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    // Mostrar todos los productos con búsqueda y filtrado
    public function index(Request $request) {
        $query = Producto::query();

        // Búsqueda por nombre
        if ($request->has('search') && $request->search != '') {
            $query->where('nombre', 'like', '%' . $request->search . '%');
        }

        // Filtrado por categoría
        if ($request->has('categoria_id') && $request->categoria_id != '') {
            $query->where('categoria_id', $request->categoria_id);
        }

        // Obtener los productos con paginación
        $productos = $query->paginate(10);

        // Obtener todas las categorías
        $categorias = Categoria::all();

        // Pasar los productos y las categorías a la vista
        return view('productos.index', compact('productos', 'categorias'));
    }

    // Mostrar el formulario para crear un nuevo producto
    public function create() {
        $categorias = Categoria::all();  // Obtener todas las categorías
        return view('productos.create', compact('categorias'));
    }

    // Almacenar un nuevo producto
    public function store(Request $request) {
        // Validación
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'categoria_id' => 'required|exists:categorias,id'  // Validar la categoría
        ]);

        // Crear el producto
        Producto::create($request->all());

        // Redirigir a la vista de productos
        return redirect()->route('productos.index')->with('success', 'Producto creado correctamente.');
    }

    // Mostrar el formulario para editar un producto
    public function edit($id)
    {
        // Obtener el producto a editar
        $producto = Producto::findOrFail($id);
        $categorias = Categoria::all();  // Obtener todas las categorías
        return view('productos.create', compact('producto', 'categorias'));  // Usamos 'create' para la edición también
    }

    // Actualizar un producto
    public function update(Request $request, $id)
    {
        // Validación
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'categoria_id' => 'required|exists:categorias,id'  // Validar la categoría
        ]);

        // Obtener el producto a actualizar
        $producto = Producto::findOrFail($id);

        // Actualizar el producto
        $producto->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'stock' => $request->stock,
            'categoria_id' => $request->categoria_id  // Actualizar la categoría
        ]);

        // Redirigir a la vista de productos con un mensaje de éxito
        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente.');
    }

    // Eliminar un producto
    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();
        return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente.');
    }
}
