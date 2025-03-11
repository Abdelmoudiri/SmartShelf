<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'id_rayon',
        'description',
        'marque',
        'promotion',
        'unit_price',
        'is_popular',
        'stock',
        'min_stock'
    ];
}
