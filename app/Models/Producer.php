<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Producer extends Model
{
    use HasFactory;

    protected $fillable = ['thumbnail', 'title'];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (Producer $producer) {
            $producer->slug = $producer->slug ?? str($producer->title)->slug();
        });
    }
    public function product(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
