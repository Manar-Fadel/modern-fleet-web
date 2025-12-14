<?php

namespace App\Http\Requests;

use App\Managers\Constants;
use Illuminate\Foundation\Http\FormRequest;

class ChangeOrderStatusRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'status' => 'required|string|in:' . implode(',', [Constants::PENDING , Constants::ACCEPTED]),
            'offer_id' => 'nullable|exists:car_quotations,id',
        ];
    }
}
