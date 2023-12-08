<?php

namespace App\Http\Resources;


use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\PropertyResource;
use App\Http\Resources\OptionValueResource;
use App\Models\Order;

class OrderItemResource extends JsonResource
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
            'created_at' => $this->created_at,
            "order_id" => $this->order_id,
            "price" => $this->price,
            "product_id" => $this->product_id,
            "quantity" => $this->quantity,
            "product" => $this->whenLoaded('product'),
            "options" => OptionValueResource::collection($this->whenLoaded("optionValues"))
                ->mapToGroups(function (OptionValueResource $item) {
                    return [$item->option->title => $item->value];
                }),
        ];
    }
}