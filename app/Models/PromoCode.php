<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\OrderItem;

class PromoCode extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'title', 'discount'];

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}