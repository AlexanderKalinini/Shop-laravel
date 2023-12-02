<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Order extends Model
{

    use HasFactory;
    protected $fillable = [
        'name',
        'surname',
        'phone_number',
        'email',
        'delivery_method',
        'city',
        'street',
        'payment_method',
        'user_id'
    ];
}
