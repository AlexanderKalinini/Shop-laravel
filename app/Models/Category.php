<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'category_id',
        'product_id',
    ];

    protected static function boot(): void
    {
        parent::boot();
        static::creating(function (Category $category) {
            $category->slug = $category->slug ?? str($category->title)->slug();
        });
    }


    public function products(): BelongsToMany
    {
        return $this->belongsToMany(
            Product::class,
            'category_product',
        );
    }
}
