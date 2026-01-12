<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CarRequestItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,

            'brand_id' => $this->brand?->id,
            'brand_name' => $this->brand?->name_en,

            'model_id' => $this->model?->id,
            'model_name' => $this->model?->name_en,

            'manufacturing_year_id' => $this->year?->id,
            'manufacturing_year_value' => $this->year?->year,

            'quantity' => $this->quantity,
            'description' => $this->description,

            'images' => CarRequestItemImageResource::collection(
                $this->whenLoaded('images')
            ),

            'created_at' => $this->created_at?->toDateTimeString(),

        ];
    }
}
