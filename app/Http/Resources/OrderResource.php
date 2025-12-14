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
        $is_trashed = $this->trashed();

        return [
            'id'                    => $this->id,
            'order_number'          => $this->order_number,
            'user_id'               => $this->user_id,
            'description'           => $this->description,
            'status'                => $this->status,
            'accepted_quotations_id'     => $this->accepted_quotations_id,
            'accepted_user_id'      => $this->accepted_user_id,
            'images'                => $this->images,

            'user_name'             => isset($this->user) ? $this->user->full_name : '',
            'user_mobile'           => isset($this->user) ? $this->user->phone_number : '',

            'brand_id'              => $this->brand_id,
            'brand_name'            => isset($this->brand) ? $this->brand->name : '',
            'brand_image'           => isset($this->brand) ? $this->brand->logo : '',

            'model_id'              => $this->model_id,
            'model_name'            => isset($this->brandModel) ? $this->brandModel->name : '',

            'year_id'               => $this->manufacturing_year_id,
            'year'                  => isset($this->year) ? $this->year->year : '',

            'quantity'              => $this->quantity,
            'offers_count'          => $this->quotations->count(),

            'view_model_id' => 'view_order_details_'.$this->id,
            'view_model_id_toggle' => '#view_order_details_'.$this->id,

            'edit_model_id' => 'edit_order_details_'.$this->id,
            'edit_model_id_toggle' => '#edit_order_details_'.$this->id,

            'change_status_model_id' => 'change_status_'.$this->id,
            'change_status_model_id_toggle' => '#change_status_'.$this->id,

            'is_trashed' => $is_trashed,
            'part_color' => $is_trashed ? 'red' : '',

            'created_at'        => $this->created_at,
            'created_at_date'   => date('Y-m-d', strtotime($this->created_at)),
            'created_at_time'   => date('h:i A', strtotime($this->created_at)),
        ];
    }
}
