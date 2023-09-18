<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSuccursaleRequest;
use App\Http\Requests\UpdateSuccursaleRequest;
use App\Http\Resources\SuccursaleResource;
use App\Models\Succursale;

class SuccursaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $succursales = Succursale::all();
        return response()->json(
            $succursales
            // new SuccursaleResource($succursales)
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSuccursaleRequest $request)
    {
        $succursale = Succursale::create([
            "nom" => $request->nom,
            "adresse" => $request->adresse,
            "telephone" => $request->telephone,
        ]);
        return response()->json(
            new SuccursaleResource($succursale)
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Succursale $succursale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Succursale $succursale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSuccursaleRequest $request, $succursale)
    {
        $succursale = Succursale::find($succursale);
        $succursale->update([
            "nom" => $request->nom,
            "adresse" => $request->adresse,
            "telephone" => $request->telephone,
        ]);
        return response()->json(
            new SuccursaleResource($succursale)
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $succursale = Succursale::find($id);
        $succursale->delete();
        return response()->json(
            [
                'message' => 'Article supprimé avec succès',
                'status' => 200
            ]
        );
    }
}
