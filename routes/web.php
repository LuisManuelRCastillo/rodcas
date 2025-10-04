<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController; 
use App\Http\Controllers\CotizacionController;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
      Route::get('/dashboard', [CotizacionController::class, 'createView'])->name('dashboard');
});
 // Cotizaciones
    Route::get('/cotizaciones', [CotizacionController::class, 'indexView'])->name('cotizaciones.index');
    Route::get('/cotizaciones/create', [CotizacionController::class, 'createView'])->name('cotizaciones.create');
    Route::post('/cotizaciones', [CotizacionController::class, 'store'])->name('cotizaciones.store');
    Route::get('/cotizaciones/{id}', [CotizacionController::class, 'showView'])->name('cotizaciones.show');

    // Búsqueda ajax de productos
    Route::get('/productos/buscar', [CotizacionController::class, 'buscarProductos'])->name('productos.buscar');

Route::get('/catalogo', [ProductoController::class, 'index'])->name('catalogo');
Route::get('/inventario', [App\Http\Controllers\InventarioController::class, 'index'])->name('stockView');