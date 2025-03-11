<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rayon extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero',
        'places',
        'id_category'
    ];

    public function category(){
        return $this->belongsTo(Category::class,'id_category');
    }
}
