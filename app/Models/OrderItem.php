<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\OptionValue;

class OrderItem extends Model
{
    use HasFactory;
    protected $fillable = ['order_id', 'product_id', 'promo_code_id', 'quantity'];

    public function optionValues(): BelongsToMany
    {
        return $this->belongsToMany(OptionValue::class)->withTimestamps();
    }
}
