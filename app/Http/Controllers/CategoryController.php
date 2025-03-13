<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * @SWG\Get(
     *     path="/categories",
     *     summary="Get a list of categories",
     *     tags={"categories"},
     *     @SWG\Response(response=200, description="Successful operation"),
     *     @SWG\Response(response=400, description="Invalid request")
     * )
     */
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    /**
     * @SWG\Post(
     *     path="/categories",
     *     summary="Create a new category",
     *     tags={"categories"},
     *     @SWG\Parameter(
     *         name="titre",
     *         in="body",
     *         required=true,
     *         type="string",
     *         description="The title of the category"
     *     ),
     *     @SWG\Parameter(
     *         name="description",
     *         in="body",
     *         required=false,
     *         type="string",
     *         description="The description of the category"
     *     ),
     *     @SWG\Response(response=201, description="Category created successfully"),
     *     @SWG\Response(response=400, description="Invalid request")
     * )
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'titre' => 'required|string',
            'description' => 'nullable|string',
        ]);
        $category = Category::create([
            'titre' => $validatedData['titre'],
            'description' => $validatedData['description'],
        ]);

        return response()->json([
            'message' => 'Rayon créé avec succès.',
            'category' => $category,
        ], 201);
    }

    /**
     * @SWG\Get(
     *     path="/categories/{id}",
     *     summary="Get a single category by ID",
     *     tags={"categories"},
     *     @SWG\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         type="integer",
     *         description="ID of the category to fetch"
     *     ),
     *     @SWG\Response(response=200, description="Successful operation"),
     *     @SWG\Response(response=404, description="Category not found")
     * )
     */
    public function show(Category $category)
    {
        return response()->json($category);
    }

    /**
     * @SWG\Put(
     *     path="/categories/{id}",
     *     summary="Update an existing category",
     *     tags={"categories"},
     *     @SWG\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         type="integer",
     *         description="ID of the category to update"
     *     ),
     *     @SWG\Parameter(
     *         name="titre",
     *         in="body",
     *         required=true,
     *         type="string",
     *         description="Updated title of the category"
     *     ),
     *     @SWG\Parameter(
     *         name="description",
     *         in="body",
     *         required=false,
     *         type="string",
     *         description="Updated description of the category"
     *     ),
     *     @SWG\Response(response=200, description="Category updated successfully"),
     *     @SWG\Response(response=400, description="Invalid request"),
     *     @SWG\Response(response=404, description="Category not found")
     * )
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category->update($validatedData);

        return response()->json([
            'message' => 'Rayon mis à jour avec succès.',
            'category' => $category,
        ]);
    }

    /**
     * @SWG\Delete(
     *     path="/categories/{id}",
     *     summary="Delete a category",
     *     tags={"categories"},
     *     @SWG\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         type="integer",
     *         description="ID of the category to delete"
     *     ),
     *     @SWG\Response(response=200, description="Category deleted successfully"),
     *     @SWG\Response(response=404, description="Category not found")
     * )
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json([
            'message' => 'Rayon supprimé avec succès.'
        ]);
    }
}
