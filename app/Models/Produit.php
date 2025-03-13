<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Produit",
 *     type="object",
 *     title="Produit",
 *     properties={
 *         @OA\Property(
 *             property="nom",
 *             type="string",
 *             description="Nom du produit",
 *             example="Produit A"
 *         ),
 *         @OA\Property(
 *             property="description",
 *             type="string",
 *             description="Description du produit",
 *             example="Ceci est un produit de haute qualité."
 *         ),
 *         @OA\Property(
 *             property="prix",
 *             type="number",
 *             format="float",
 *             description="Prix du produit",
 *             example=19.99
 *         ),
 *         @OA\Property(
 *             property="quantite",
 *             type="integer",
 *             description="Quantité du produit",
 *             example=100
 *         ),
 *         @OA\Property(
 *             property="categorie_id",
 *             type="integer",
 *             description="ID de la catégorie du produit",
 *             example=1
 *         )
 *     }
 * )
 */

class Produit extends Model
{
    /** @use HasFactory<\Database\Factories\ProduitFactory> */
    use HasFactory;
    protected $guarded = [];

    public function rayon()
    {
        return $this->belongsTo(Rayon::class);
    }
    
}
