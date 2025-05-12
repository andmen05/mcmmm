<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\ProfileController;

// Página principal (inicio)
Route::get('/', function () {
    return view('welcome');
});

// Rutas que requieren autenticación
Route::middleware('auth')->group(function () {

    // Dashboard (solo accesible por usuarios autenticados)
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Rutas de clientes, productos y ventas solo accesibles por usuarios autenticados
    Route::resource('clientes', ClienteController::class);
    Route::resource('productos', ProductoController::class);
    Route::resource('ventas', VentaController::class);
    Route::get('ventas/{venta}/factura', [VentaController::class, 'factura'])->name('ventas.factura');


    // Rutas para editar y eliminar el perfil del usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rutas de autenticación
require __DIR__.'/auth.php';
