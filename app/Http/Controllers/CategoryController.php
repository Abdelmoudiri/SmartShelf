<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Http\Requests\StorecategoryRequest;
use App\Http\Requests\UpdatecategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        
        $categories = Category::all();
        return response()->json($categories,200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
        ]);

        if($validator->fails()){
            return response([
                'message' => 'Invalid Nom de Catégorie'
            ]);
        }

        $validatedData = $validator->validate();

        $category = Category::create($validatedData);

        return response()->json([
            'message' => 'Catégorie créée avec succès',
            'category' => $category,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(category $category)
    {
        return response()->json($category);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, category $category)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
        ]);

        if($validator->fails()){
            return response([
                'message' => 'Invalid Nom de Catégorie'
            ]);
        }

        $validatedData = $validator->validate();

        $category->update([
            "name" => $validatedData['name']
        ]);

        return response()->json([
            'message' => 'Catégorie mise à jour avec succès',
            'category' => $category,
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(category $category)
    {
        $category->delete();
        return response()->json([
            "message" => "Categorie Supprimé avec Succés !" 
        ]);
    }
}
