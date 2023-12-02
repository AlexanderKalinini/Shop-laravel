<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\OrderItem;
use App\Models\Product;

class OptionValue extends Model
{
    use HasFactory;
    protected $fillable = ['option_id', 'value'];

    public function option(): BelongsTo
    {
        return $this->belongsTo(Option::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    public function orderItems(): BelongsToMany
    {
        return $this->belongsToMany(OrderItem::class)->withTimestamps();
    }
}
