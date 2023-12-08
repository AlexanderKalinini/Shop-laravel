<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            'name' => $this->name,
            'surname' => $this->surname,
            'phone_number' => $this->phone_number,
            'email' => $this->email,
            "delivery_method" => $this->payment_method,
            "country" => $this->country,
            'city' => $this->city,
            'street' => $this->street,
            'payment_method' => $this->payment_method,
            'total_price' => $this->total_price,
            "status" => $this->status,
        ];
    }
}