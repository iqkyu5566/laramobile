<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Products extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'price',
        'description',
        'tags',
        'categories_id',
    ];

    public function galleries()
    {
        return $this->hasMany(ProductGalleries::class, 'products_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(ProductCategories::class, 'categories_id', 'id');
    }
}
