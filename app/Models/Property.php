<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Product;

class Property extends Model
{
    use HasFactory;
    protected $fillable = ['title'];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}
