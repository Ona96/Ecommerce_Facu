<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\OrdenController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductoController as AdminProductoController;
use App\Http\Controllers\Admin\OrdenController as AdminOrdenController;
use App\Http\Controllers\Admin\PerfilController; // Agregar esta importación

// Rutas públicas
Route::get('/', [ProductoController::class, 'destacados'])->name('inicio');
Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
Route::get('/productos/{id}', [ProductoController::class, 'mostrar'])->name('productos.mostrar');

// Rutas de autenticación
Route::get('/login', [LoginController::class, 'mostrarFormularioLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/registro', [RegisterController::class, 'mostrarFormularioRegistro'])->name('registro');
Route::post('/registro', [RegisterController::class, 'registrar']);

// Rutas protegidas
Route::middleware('auth')->group(function () {
    // Rutas del carrito
    Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito.index');
    Route::post('/carrito/agregar', [CarritoController::class, 'agregar'])->name('carrito.agregar');
    Route::put('/carrito/{id}', [CarritoController::class, 'actualizar'])->name('carrito.actualizar');
    Route::delete('/carrito/{id}', [CarritoController::class, 'eliminar'])->name('carrito.eliminar');
    Route::delete('/carrito', [CarritoController::class, 'vaciar'])->name('carrito.vaciar');
    
    // Rutas de órdenes
    Route::get('/ordenes', [OrdenController::class, 'index'])->name('ordenes.index');
    Route::get('/ordenes/{id}', [OrdenController::class, 'mostrar'])->name('ordenes.mostrar');
    Route::get('/checkout', [OrdenController::class, 'checkout'])->name('checkout');
    Route::post('/checkout', [OrdenController::class, 'guardar'])->name('ordenes.guardar');
    
    // Rutas de administración
    Route::middleware(\App\Http\Middleware\CheckAdmin::class)->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        // Rutas de productos para admin
        Route::get('/productos', [AdminProductoController::class, 'index'])->name('productos.index');
        Route::get('/productos/crear', [AdminProductoController::class, 'crear'])->name('productos.crear');
        Route::post('/productos', [AdminProductoController::class, 'guardar'])->name('productos.guardar');
        Route::get('/productos/{id}/editar', [AdminProductoController::class, 'editar'])->name('productos.editar');
        Route::put('/productos/{id}', [AdminProductoController::class, 'actualizar'])->name('productos.actualizar');
        Route::delete('/productos/{id}', [AdminProductoController::class, 'eliminar'])->name('productos.eliminar');
        
        // Rutas de órdenes para admin
        Route::get('/ordenes', [AdminOrdenController::class, 'index'])->name('ordenes.index');
        Route::get('/ordenes/{id}', [AdminOrdenController::class, 'mostrar'])->name('ordenes.mostrar');
        Route::put('/ordenes/{id}/estado', [AdminOrdenController::class, 'actualizarEstado'])->name('ordenes.estado');
        Route::get('/ordenes/{id}/editar', [AdminOrdenController::class, 'editar'])->name('ordenes.editar');
        Route::put('/ordenes/{id}', [AdminOrdenController::class, 'actualizar'])->name('ordenes.actualizar');
        Route::delete('/ordenes/{id}', [AdminOrdenController::class, 'eliminar'])->name('ordenes.eliminar');
        
        // Rutas para cambio de contraseña (agregar estas rutas)
        Route::get('/perfil/cambiar-password', [PerfilController::class, 'editarPassword'])->name('perfil.password');
        Route::put('/perfil/cambiar-password', [PerfilController::class, 'actualizarPassword'])->name('perfil.actualizar-password');
    });
});
