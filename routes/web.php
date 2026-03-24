<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;

// Páginas informativas
Route::get('/', [PageController::class, 'inicio'])->name('inicio');
Route::get('/nosotros', [PageController::class, 'nosotros'])->name('nosotros');
Route::get('/contacto', [PageController::class, 'contacto'])->name('contacto');
Route::post('/contacto', [PageController::class, 'contacto'])->name('contacto.post');

// Catálogo y detalle de productos
Route::get('/catalogo', [ProductController::class, 'index'])->name('catalogo');
Route::get('/catalogo/{id}', [ProductController::class, 'show'])->name('producto.detalle');

// Carrito de compras
Route::get('/carrito', [App\Http\Controllers\CarritoController::class, 'index'])->name('carrito.index');
Route::post('/carrito/agregar', [App\Http\Controllers\CarritoController::class, 'agregar'])->name('carrito.agregar');
Route::post('/carrito/actualizar/{id}', [App\Http\Controllers\CarritoController::class, 'actualizar'])->name('carrito.actualizar');
Route::post('/carrito/eliminar/{id}', [App\Http\Controllers\CarritoController::class, 'eliminar'])->name('carrito.eliminar');
Route::post('/carrito/vaciar', [App\Http\Controllers\CarritoController::class, 'vaciar'])->name('carrito.vaciar');

// Autenticación de clientes
Route::get('/registro', [App\Http\Controllers\Auth\ClienteController::class, 'showRegister'])->name('cliente.register');
Route::post('/registro', [App\Http\Controllers\Auth\ClienteController::class, 'register'])->name('cliente.register.post');
Route::get('/login', [App\Http\Controllers\Auth\ClienteController::class, 'showLogin'])->name('cliente.login');
Route::post('/login', [App\Http\Controllers\Auth\ClienteController::class, 'login'])->name('cliente.login.post');
Route::post('/logout', [App\Http\Controllers\Auth\ClienteController::class, 'logout'])->name('cliente.logout');
Route::get('/perfil', [App\Http\Controllers\Auth\ClienteController::class, 'perfil'])->name('cliente.perfil');
Route::get('/perfil/editar', [App\Http\Controllers\Auth\ClienteController::class, 'showEditar'])->name('cliente.editar');
Route::put('/perfil/actualizar', [App\Http\Controllers\Auth\ClienteController::class, 'actualizar'])->name('cliente.actualizar');
Route::post('/perfil/password', [App\Http\Controllers\Auth\ClienteController::class, 'cambiarPassword'])->name('cliente.password');