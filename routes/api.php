<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\SupervisorController;
use App\Http\Controllers\ZonaController;
use App\Http\Controllers\VendedorController;
use App\Http\Controllers\TitularController;
use App\Http\Controllers\TiendaController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\VentaItemController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

/*
|--------------------------------------------------------------------------
| ZONAS API ROUTES
|--------------------------------------------------------------------------
*/
Route::apiResource('zonas', ZonaController::class);

/*
|--------------------------------------------------------------------------
| SUPERVISORES API ROUTES
|--------------------------------------------------------------------------
*/
Route::apiResource('supervisores', SupervisorController::class);
Route::get('supervisores/activos', [SupervisorController::class, 'activos'])->name('supervisores.activos');

/*
|--------------------------------------------------------------------------
| VENDEDORES API ROUTES
|--------------------------------------------------------------------------
*/
Route::apiResource('vendedores', VendedorController::class);
Route::get('vendedores/activos', [VendedorController::class, 'activos'])->name('vendedores.activos');
Route::get('vendedores/tipo/{tipo}', [VendedorController::class, 'byTipo'])->name('vendedores.byTipo');

/*
|--------------------------------------------------------------------------
| TITULARES API ROUTES
|--------------------------------------------------------------------------
*/
Route::apiResource('titulares', TitularController::class);
Route::get('titulares/activos', [TitularController::class, 'activos'])->name('titulares.activos');

/*
|--------------------------------------------------------------------------
| TIENDAS API ROUTES
|--------------------------------------------------------------------------
*/
Route::apiResource('tiendas', TiendaController::class);
Route::get('tiendas/activas', [TiendaController::class, 'activas'])->name('tiendas.activas');
Route::get('tiendas/zona/{zona_id}', [TiendaController::class, 'byZona'])->name('tiendas.byZona');

/*
|--------------------------------------------------------------------------
| PRODUCTOS API ROUTES
|--------------------------------------------------------------------------
*/
Route::apiResource('productos', ProductoController::class);
Route::get('productos/en-stock', [ProductoController::class, 'enStock'])->name('productos.enStock');

/*
|--------------------------------------------------------------------------
| VENTAS API ROUTES
|--------------------------------------------------------------------------
*/
Route::apiResource('ventas', VentaController::class);
Route::get('ventas/completadas', [VentaController::class, 'completadas'])->name('ventas.completadas');
Route::get('ventas/pendientes', [VentaController::class, 'pendientes'])->name('ventas.pendientes');
Route::post('ventas/rango-fechas', [VentaController::class, 'byDateRange'])->name('ventas.byDateRange');

/*
|--------------------------------------------------------------------------
| VENTAS ITEMS API ROUTES
|--------------------------------------------------------------------------
*/
Route::apiResource('ventas-items', VentaItemController::class)->only(['index', 'show']);
Route::get('ventas/{venta_id}/items', [VentaItemController::class, 'byVenta'])->name('ventas.items');
Route::get('productos/{producto_id}/ventas-items', [VentaItemController::class, 'byProducto'])->name('productos.ventasItems');
