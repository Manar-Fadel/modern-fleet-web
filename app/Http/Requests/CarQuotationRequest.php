<?php

namespace App\Http\Requests;

use App\Managers\Constants;
use Illuminate\Foundation\Http\FormRequest;

class CarQuotationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'request_id'  => ['required', 'exists:car_requests,id'],
            'user_id'     => ['required', 'exists:users,id'],

            'unit_price'  => ['required', 'numeric', 'min:1'],
            'total_price' => ['required', 'numeric', 'min:1'],

            'is_with_vat' => ['required', 'boolean'],

            'status'      => ['required', 'in:'.Constants::PENDING.','.Constants::REJECTED.','.Constants::ACCEPTED.','.Constants::PAID.','.Constants::IN_DELIVERY],

            'description' => ['nullable', 'string', 'max:2000'],
        ];
    }
}
