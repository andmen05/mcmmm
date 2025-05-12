<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = ['nombre', 'descripcion', 'precio', 'stock', 'categoria_id'];
    public $timestamps = true;

    // Relación con los detalles de la venta
    public function detalles()
    {
        return $this->hasMany(\App\Models\DetalleVenta::class);
    }

    // Relación con la categoría
    public function categoria()
    {
        return $this->belongsTo(\App\Models\Categoria::class);
    }
}
