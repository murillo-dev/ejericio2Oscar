<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendedor;

class VendedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vendedores = Vendedor::with(['zona', 'supervisor'])->paginate(15);
        return response()->json($vendedores);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:vendedores',
            'telefono' => 'nullable|string|max:20',
            'tipo' => 'required|string|in:directo,indirecto',
            'zona_id' => 'required|exists:zonas,id',
            'supervisor_id' => 'required|exists:supervisores,id',
            'activo' => 'boolean'
        ]);

        $vendedor = Vendedor::create($validated);
        return response()->json($vendedor, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $vendedor = Vendedor::with(['zona', 'supervisor'])->findOrFail($id);
        return response()->json($vendedor);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $vendedor = Vendedor::findOrFail($id);

        $validated = $request->validate([
            'nombre' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:vendedores,email,' . $id,
            'telefono' => 'nullable|string|max:20',
            'tipo' => 'sometimes|string|in:directo,indirecto',
            'zona_id' => 'sometimes|exists:zonas,id',
            'supervisor_id' => 'sometimes|exists:supervisores,id',
            'activo' => 'boolean'
        ]);

        $vendedor->update($validated);
        return response()->json($vendedor);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $vendedor = Vendedor::findOrFail($id);
        $vendedor->delete();
        return response()->json(null, 204);
    }

    /**
     * Get active vendors.
     */
    public function activos()
    {
        $vendedores = Vendedor::activos()->with(['zona', 'supervisor'])->paginate(15);
        return response()->json($vendedores);
    }

    /**
     * Get vendors by type.
     */
    public function byTipo(string $tipo)
    {
        $vendedores = Vendedor::byTipo($tipo)->with(['zona', 'supervisor'])->paginate(15);
        return response()->json($vendedores);
    }
}
