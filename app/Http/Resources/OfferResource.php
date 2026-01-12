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
            'user_id'               => $this->user_id,
            'unit_price'            => $this->unit_price,
            'attachment_price'      => $this->attachment_price,
            'vat_amount'            => $this->vat_amount,
            'total_with_vat'        => $this->total_with_vat,
            'total_price'           => $this->total_price,

            'is_with_vat'           => $this->is_with_vat,
            'is_with_vat_text'      => is_null($this->is_with_vat) == 1 ?  'Not Specified' : ($this->is_with_vat == 1 ? 'With Vat' : 'Without Vat'),

            'description'           => $this->description,
            'status'                => $this->status,
            'images'                => $this->images,

            'created_at' => $this->created_at?->toDateTimeString(),
        ];
    }
}
