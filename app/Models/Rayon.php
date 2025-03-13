<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Rayon",
 *     type="object",
 *     title="Rayon",
 *     properties={
 *         @OA\Property(
 *             property="nom",
 *             type="string",
 *             description="Nom du rayon",
 *             example="Rayon A"
 *         ),
 *         @OA\Property(
 *             property="description",
 *             type="string",
 *             description="Description du rayon",
 *             example="Rayon pour les produits en promotion."
 *         ),
 *         @OA\Property(
 *             property="category_id",
 *             type="integer",
 *             description="ID de la catégorie du rayon",
 *             example=2
 *         )
 *     }
 * )
 */

class Rayon extends Model
{
    /** @use HasFactory<\Database\Factories\RayonFactory> */
    use HasFactory;

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function produits()
    {
        return $this->hasMany(Produit::class);
    }
}
