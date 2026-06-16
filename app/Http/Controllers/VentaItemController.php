<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VentaItem;

class VentaItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = VentaItem::with(['venta', 'producto'])->paginate(15);
        return response()->json($items);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $item = VentaItem::with(['venta', 'producto'])->findOrFail($id);
        return response()->json($item);
    }

    /**
     * Get items by sale.
     */
    public function byVenta(string $venta_id)
    {
        $items = VentaItem::where('venta_id', $venta_id)
            ->with(['venta', 'producto'])
            ->paginate(15);
        return response()->json($items);
    }

    /**
     * Get items by product.
     */
    public function byProducto(string $producto_id)
    {
        $items = VentaItem::where('producto_id', $producto_id)
            ->with(['venta', 'producto'])
            ->paginate(15);
        return response()->json($items);
    }
}
