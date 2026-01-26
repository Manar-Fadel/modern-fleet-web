<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OfferResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                    => $this->id,
            'total_amount'          => $this->total_amount,
            'vat_amount'            => $this->vat_amount,
            'total_with_vat'        => $this->total_with_vat,
            'status'                => $this->status,
            'created_at' => $this->created_at?->toDateTimeString(),
        ];
    }
}
