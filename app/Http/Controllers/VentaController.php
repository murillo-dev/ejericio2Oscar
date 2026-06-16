<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\VentaItem;
use App\Models\Producto;
use Illuminate\Support\Facades\DB;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ventas = Venta::with(['ventaItems.producto', 'vendedor', 'tienda'])->paginate(15);
        return response()->json($ventas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'fecha' => 'required|date',
            'vendedor_id' => 'required|exists:vendedores,id',
            'tienda_id' => 'required|exists:tiendas,id',
            'estado' => 'required|string|in:pendiente,completada,cancelada',
            'items' => 'required|array|min:1',
            'items.*.producto_id' => 'required|exists:productos,id',
            'items.*.cantidad' => 'required|integer|min:1',
            'items.*.precio_unitario' => 'required|numeric|min:0.01'
        ]);

        return DB::transaction(function () use ($validated) {
            $total = 0;
            $items = [];

            foreach ($validated['items'] as $item) {
                $producto = Producto::findOrFail($item['producto_id']);
                $subtotal = $item['cantidad'] * $item['precio_unitario'];
                $total += $subtotal;

                if ($producto->stock < $item['cantidad']) {
                    throw new \Exception("Stock insuficiente para {$producto->nombre}");
                }

                $items[] = [
                    'producto_id' => $item['producto_id'],
                    'cantidad' => $item['cantidad'],
                    'precio_unitario' => $item['precio_unitario'],
                    'subtotal' => $subtotal
                ];

                $producto->decrement('stock', $item['cantidad']);
            }

            $venta = Venta::create([
                'fecha' => $validated['fecha'],
                'vendedor_id' => $validated['vendedor_id'],
                'tienda_id' => $validated['tienda_id'],
                'estado' => $validated['estado'],
                'total' => $total
            ]);

            foreach ($items as $item) {
                $item['venta_id'] = $venta->id;
                VentaItem::create($item);
            }

            return $venta->load(['ventaItems.producto', 'vendedor', 'tienda']);
        });
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $venta = Venta::with(['ventaItems.producto', 'vendedor', 'tienda'])->findOrFail($id);
        return response()->json($venta);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $venta = Venta::findOrFail($id);

        $validated = $request->validate([
            'estado' => 'sometimes|string|in:pendiente,completada,cancelada'
        ]);

        $venta->update($validated);
        return response()->json($venta);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $venta = Venta::findOrFail($id);
        $venta->delete();
        return response()->json(null, 204);
    }

    /**
     * Get completed sales.
     */
    public function completadas()
    {
        $ventas = Venta::completadas()->with(['ventaItems.producto', 'vendedor', 'tienda'])->paginate(15);
        return response()->json($ventas);
    }

    /**
     * Get pending sales.
     */
    public function pendientes()
    {
        $ventas = Venta::pendientes()->with(['ventaItems.producto', 'vendedor', 'tienda'])->paginate(15);
        return response()->json($ventas);
    }

    /**
     * Get sales by date range.
     */
    public function byDateRange(Request $request)
    {
        $validated = $request->validate([
            'desde' => 'required|date',
            'hasta' => 'required|date|after_or_equal:desde'
        ]);

        $ventas = Venta::whereBetween('fecha', [$validated['desde'], $validated['hasta']])
            ->with(['ventaItems.producto', 'vendedor', 'tienda'])
            ->paginate(15);
        return response()->json($ventas);
    }
}
