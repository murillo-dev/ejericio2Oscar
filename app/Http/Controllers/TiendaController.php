<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tienda;

class TiendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tiendas = Tienda::with(['zona', 'titular'])->paginate(15);
        return response()->json($tiendas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255|unique:tiendas',
            'direccion' => 'nullable|string',
            'zona_id' => 'required|exists:zonas,id',
            'titular_id' => 'required|exists:titulares,id',
            'activo' => 'boolean'
        ]);

        $tienda = Tienda::create($validated);
        return response()->json($tienda, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tienda = Tienda::with(['zona', 'titular'])->findOrFail($id);
        return response()->json($tienda);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $tienda = Tienda::findOrFail($id);

        $validated = $request->validate([
            'nombre' => 'sometimes|string|max:255|unique:tiendas,nombre,' . $id,
            'direccion' => 'nullable|string',
            'zona_id' => 'sometimes|exists:zonas,id',
            'titular_id' => 'sometimes|exists:titulares,id',
            'activo' => 'boolean'
        ]);

        $tienda->update($validated);
        return response()->json($tienda);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tienda = Tienda::findOrFail($id);
        $tienda->delete();
        return response()->json(null, 204);
    }

    /**
     * Get active stores.
     */
    public function activas()
    {
        $tiendas = Tienda::activas()->with(['zona', 'titular'])->paginate(15);
        return response()->json($tiendas);
    }

    /**
     * Get stores by zone.
     */
    public function byZona(string $zona_id)
    {
        $tiendas = Tienda::where('zona_id', $zona_id)
            ->with(['zona', 'titular'])
            ->paginate(15);
        return response()->json($tiendas);
    }
}
