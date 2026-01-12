<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CarRequestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $is_trashed = $this->trashed();

        return [
            'id'                    => $this->id,
            'order_number'          => $this->order_number,
            'status'                => $this->status,
            'type' => $this->type,
            'notes' => $this->notes,
            'created_at' => $this->created_at?->toDateTimeString(),

            'user_id' => $this->user?->id,
            'user_name' => $this->user?->full_name,
            'user_mobile' => $this->user?->phone_number,
            'email' => $this->user?->email,

            'items' => CarRequestItemResource::collection(
                $this->whenLoaded('items')
            ),

            'accepted_quotations_id'     => $this->accepted_quotations_id,
            'accepted_user_id'      => $this->accepted_user_id,


            'offers_count'          => $this->quotations->count(),

            'view_model_id' => 'view_order_details_'.$this->id,
            'view_model_id_toggle' => '#view_order_details_'.$this->id,

            'edit_model_id' => 'edit_order_details_'.$this->id,
            'edit_model_id_toggle' => '#edit_order_details_'.$this->id,

            'change_status_model_id' => 'change_status_'.$this->id,
            'change_status_model_id_toggle' => '#change_status_'.$this->id,

            'is_trashed' => $is_trashed,
            'part_color' => $is_trashed ? 'red' : '',
        ];
    }
}
