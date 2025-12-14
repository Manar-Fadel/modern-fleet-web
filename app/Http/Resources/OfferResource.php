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
            'offer_number'          => $this->offer_number,
            'user_id'               => $this->user_id,
            'price'                 => $this->price,
            'is_with_vat'           => $this->is_with_vat,
            'is_with_vat_text'      => is_null($this->is_with_vat) == 1 ?  'Not Specified' : ($this->is_with_vat == 1 ? 'With Vat' : 'Without Vat'),
            'description'           => $this->description,
            'status'                => $this->status,
            'images'                => $this->images,

            'dealer_name'             => isset($this->user) ? $this->user->full_name : '',
            'dealer_mobile'           => isset($this->user) ? $this->user->phone_number : '',

            'order_number'          => isset($this->request) ? $this->request->order_number : '',
            'view_model_id' => isset($this->request) ? 'view_order_details_'.$this->request->id : '',
            'view_model_id_toggle' => isset($this->request) ? '#view_order_details_'.$this->request->id : '',
            'order' => isset($this->request) ? new OrderResource($this->request) : null,


            'offers_table_from' => ($request->get('id') !== null && $request->id > 0) ? 'FROM_VIEW_ORDER_OFFERS' : 'FROM_LISTING_OFFERS',

            'created_at'        => $this->created_at,
            'created_at_date'   => date('Y-m-d', strtotime($this->created_at)),
            'created_at_time'   => date('h:i A', strtotime($this->created_at)),
        ];
    }
}
