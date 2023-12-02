<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Brand;
use App\Models\Property;
use App\Models\OptionValue;
use App\Models\Category;
use App\Models\Traits\Filterable;
use App\Models\Description;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory, Filterable;

    protected $fillable = [
        'title',
        'slug',
        'thumbnail',
        'price',
        'old_price',
        'brand_id',
        'producer_id',
        'category_id',
        'product_id',
        'property_id'
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (Product $product) {
            $product->slug = $product->slug ?? str($product->title)->slug();
        });
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(
            Brand::class,
            'brand_id',
            'id'
        );
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(
            Category::class,
        );
    }

    public function producer(): BelongsTo
    {
        return $this->belongsTo(Producer::class);
    }

    public function properties(): BelongsToMany
    {
        return $this->belongsToMany(Property::class)->withPivot('value');
    }



    public function optionValues(): BelongsToMany
    {
        return $this->belongsToMany(OptionValue::class)->withPivot('quantity');
    }

    public function descriptions(): HasMany
    {
        return $this->hasMany(Description::class);
    }
}
