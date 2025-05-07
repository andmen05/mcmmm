<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = ['nombre', 'email', 'telefono'];
    public $timestamps = false;

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

