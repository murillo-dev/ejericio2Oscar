<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Zona;

class ZonaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $zonas = Zona::with(['tiendas', 'vendedores'])->paginate(15);
        return response()->json($zonas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255|unique:zonas',
            'descripcion' => 'nullable|string',
            'codigo' => 'nullable|string|unique:zonas'
        ]);

        $zona = Zona::create($validated);
        return response()->json($zona, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $zona = Zona::with(['tiendas', 'vendedores'])->findOrFail($id);
        return response()->json($zona);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $zona = Zona::findOrFail($id);

        $validated = $request->validate([
            'nombre' => 'sometimes|string|max:255|unique:zonas,nombre,' . $id,
            'descripcion' => 'nullable|string',
            'codigo' => 'nullable|string|unique:zonas,codigo,' . $id
        ]);

        $zona->update($validated);
        return response()->json($zona);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $zona = Zona::findOrFail($id);
        $zona->delete();
        return response()->json(null, 204);
    }
}
