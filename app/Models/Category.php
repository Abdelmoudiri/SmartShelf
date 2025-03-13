<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Category",
 *     type="object",
 *     title="Category",
 *     properties={
 *         @OA\Property(
 *             property="titre",
 *             type="string",
 *             description="Titre de la catégorie",
 *             example="Électronique"
 *         ),
 *         @OA\Property(
 *             property="description",
 *             type="string",
 *             description="Description de la catégorie",
 *             example="Catégorie pour tous les produits électroniques."
 *         )
 *     }
 * )
 */

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;

    protected $table = 'categories';
    protected $guarded = [];

    
    public function rayons()
    {
        return $this->hasMany(Rayon::class);
    }

}
