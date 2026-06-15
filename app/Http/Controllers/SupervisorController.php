<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supervisor;

class SupervisorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $supervisores = Supervisor::all();
        return response()->json($supervisores);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $supervisor = Supervisor::create($request->all());
        return response()->json($supervisor, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $supervisor = Supervisor::findOrFail($id);
        return response()->json($supervisor);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $supervisor = Supervisor::findOrFail($id);
        $supervisor->update($request->all());
        return response()->json($supervisor);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $supervisor = Supervisor::findOrFail($id);
        $supervisor->delete();
        return response()->json(null, 204);
    }
}
