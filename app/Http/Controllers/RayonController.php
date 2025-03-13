<?php

namespace App\Http\Controllers;

use App\Models\Rayon;
use App\Http\Requests\StoreRayonRequest;
use App\Http\Requests\UpdateRayonRequest;
use Illuminate\Support\Facades\Request;

class RayonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        // Validation des données entrantes
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
        ]);
    
        // Création du rayon
        $rayon = Rayon::create([
            'nom' => $validatedData['nom'],
            'description' => $validatedData['description'],
            'category_id' => $validatedData['category_id'],
        ]);
    
        // Retourner une réponse (par exemple, redirection ou JSON)
        return response()->json([
            'message' => 'Rayon créé avec succès.',
            'rayon' => $rayon,
        ], 201);
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Rayon $rayon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rayon $rayon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRayonRequest $request, Rayon $rayon)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rayon $rayon)
    {
        //
    }
}
