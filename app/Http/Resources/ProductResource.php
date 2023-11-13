<?php

namespace App\Http\Resources;


use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\PropertyResource;
use App\Http\Resources\OptionValueResource;



class ProductResource extends JsonResource
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
            "title" => $this->title,
            "thumbnail" => $this->thumbnail,
            "price" => $this->price,
            "old_price" => $this->old_price,
            "brand_id" => $this->brand_id,
            "producer_id" => $this->producer_id,
            "count_estimates" => $this->estimates,
            "properties" => PropertyResource::collection($this->whenLoaded('properties')),
            "options" => OptionValueResource::collection($this->whenLoaded("optionValues"))
                ->mapToGroups(function (OptionValueResource $item) {
                    return [$item->option->title => $item->value];
                }),
            "descriptions" => $this->descriptions
        ];
    }
}
