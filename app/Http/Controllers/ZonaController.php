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
        //
        $zonas = Zona::all();
        return response()->json($zonas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $zona = Zona::create($request->all());
        return response()->json($zona, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $zona = Zona::findOrFail($id);
        return response()->json($zona);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $zona = Zona::findOrFail($id);
        $zona->update($request->all());
        return response()->json($zona);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $zona = Zona::findOrFail($id);
        $zona->delete();
        return response()->json(null, 204);
    }
}
