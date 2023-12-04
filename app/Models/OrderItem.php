<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\OptionValue;
use App\Models\Product;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Order;

class OrderItem extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['order_id', 'product_id', 'promo_code_id', 'price', 'quantity'];

    public function optionValues(): BelongsToMany
    {
        return $this->belongsToMany(OptionValue::class)->withTimestamps();
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}