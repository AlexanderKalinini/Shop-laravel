<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\OrderItem;

class Order extends Model
{

    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'surname',
        'phone_number',
        'email',
        'delivery_method',
        'country',
        'city',
        'street',
        'payment_method',
        'user_id',
        'total_price',
        'status'
    ];

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}