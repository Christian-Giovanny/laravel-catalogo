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