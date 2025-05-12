<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = ['nombre', 'email', 'telefono'];
    public $timestamps = true;

    public function ventas()
    {
        return $this->hasMany(Venta::class, 'cliente_id');
    }

    protected static function booted()
    {
        static::deleting(function ($cliente) {
            $cliente->ventas()->delete(); // Elimina las ventas antes de eliminar al cliente
        });
    }
}

