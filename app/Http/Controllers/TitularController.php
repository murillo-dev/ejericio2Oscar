<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Titular;

class TitularController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $titulares = Titular::with('tiendas')->paginate(15);
        return response()->json($titulares);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:titulares',
            'telefono' => 'nullable|string|max:20',
            'documento' => 'nullable|string|unique:titulares',
            'activo' => 'boolean'
        ]);

        $titular = Titular::create($validated);
        return response()->json($titular, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $titular = Titular::with('tiendas')->findOrFail($id);
        return response()->json($titular);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $titular = Titular::findOrFail($id);

        $validated = $request->validate([
            'nombre' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:titulares,email,' . $id,
            'telefono' => 'nullable|string|max:20',
            'documento' => 'nullable|string|unique:titulares,documento,' . $id,
            'activo' => 'boolean'
        ]);

        $titular->update($validated);
        return response()->json($titular);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $titular = Titular::findOrFail($id);
        $titular->delete();
        return response()->json(null, 204);
    }

    /**
     * Get active proprietors.
     */
    public function activos()
    {
        $titulares = Titular::activos()->with('tiendas')->paginate(15);
        return response()->json($titulares);
    }
}
