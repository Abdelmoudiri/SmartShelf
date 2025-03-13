<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Http\Requests\StoreProduitRequest;
use App\Http\Requests\UpdateProduitRequest;
use Illuminate\Http\Request;

/**
 * @OA\Info(
 *     title="SmartShelf API",
 *     version="1.0.0",
 *     description="API documentation for SmartShelf project"
 * )
 * @OA\Tag(name="Produits", description="Gestion des produits")
 */
class ProduitController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/produits",
     *     summary="Lister tous les produits",
     *     tags={"Produits"},
     *     @OA\Response(
     *         response=200,
     *         description="Liste des produits",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Produit"))
     *     )
     * )
     */
    public function index()
    {
        $produits = Produit::all();
        return response()->json($produits);
    }

    /**
     * @OA\Post(
     *     path="/api/produits",
     *     summary="Créer un nouveau produit",
     *     tags={"Produits"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Produit")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Produit créé avec succès",
     *         @OA\JsonContent(ref="#/components/schemas/Produit")
     *     )
     * )
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'prix' => 'required|numeric|min:0',
            'quantite' => 'required|integer|min:0',
            'categorie_id' => 'required|exists:categories,id',
        ]);

        $produit = Produit::create($validatedData);

        return response()->json([
            'message' => 'Produit créé avec succès',
            'produit' => $produit,
        ], 201);
    }

    /**
     * @OA\Get(
     *     path="/api/produits/{id}",
     *     summary="Afficher un produit spécifique",
     *     tags={"Produits"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID du produit",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Détails du produit",
     *         @OA\JsonContent(ref="#/components/schemas/Produit")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Produit non trouvé"
     *     )
     * )
     */
    public function show(Produit $produit)
    {
        return response()->json($produit);
    }

    /**
     * @OA\Put(
     *     path="/api/produits/{id}",
     *     summary="Mettre à jour un produit",
     *     tags={"Produits"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID du produit",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Produit")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Produit mis à jour avec succès",
     *         @OA\JsonContent(ref="#/components/schemas/Produit")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Produit non trouvé"
     *     )
     * )
     */
    public function update(Request $request, Produit $produit)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'prix' => 'required|numeric|min:0',
            'quantite' => 'required|integer|min:0',
            'categorie_id' => 'required|exists:categories,id',
        ]);

        $produit->update($validatedData);

        return response()->json([
            'message' => 'Produit mis à jour avec succès',
            'produit' => $produit,
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/api/produits/{id}",
     *     summary="Supprimer un produit",
     *     tags={"Produits"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID du produit",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Produit supprimé avec succès"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Produit non trouvé"
     *     )
     * )
     */
    public function destroy(Produit $produit)
    {
        $produit->delete();

        return response()->json([
            'message' => 'Produit supprimé avec succès',
        ]);
    }

    /**
     * @OA\Schema(
     *     schema="Produit",
     *     type="object",
     *     title="Produit",
     *     properties={
     *         @OA\Property(
     *             property="nom",
     *             type="string",
     *             description="Nom du produit"
     *         ),
     *         @OA\Property(
     *             property="description",
     *             type="string",
     *             description="Description du produit"
     *         ),
     *         @OA\Property(
     *             property="prix",
     *             type="number",
     *             format="float",
     *             description="Prix du produit"
     *         ),
     *         @OA\Property(
     *             property="quantite",
     *             type="integer",
     *             description="Quantité du produit"
     *         ),
     *         @OA\Property(
     *             property="categorie_id",
     *             type="integer",
     *             description="ID de la catégorie du produit"
     *         )
     *     }
     * )
     */
}