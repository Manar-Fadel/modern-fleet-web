<?php

namespace App\Http\Requests\web;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
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
            'requests' => ['required','array','min:1'],

            'requests.*.brand_id' => ['required','exists:brands,id'],
            'requests.*.model_id' => ['required','exists:brand_models,id'],
            'requests.*.manufacturing_year_id' => ['nullable','exists:manufacturing_years,id'],
            'requests.*.quantity' => ['nullable','integer','min:1'],
            'requests.*.description' => ['nullable','string','max:2000'],

            //'requests.*.is_attachments_enabled' => 'boolean',
            'requests.*.attachment_type_id' => 'nullable|required_if:requests.*.is_attachments_enabled,1|exists:attachment_types,id',
            'requests.*.attachment_description' => 'nullable|required_if:requests.*.is_attachments_enabled,1|string|max:2000',

            'requests.*.images' => ['nullable','array'],
            'requests.*.images.*' => ['image','max:5048'],
        ];
    }
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator){

        $errors = $validator->errors();
        $response = new \Illuminate\Http\JsonResponse([
            'status' => false,
            'message' => $errors->first() ,
            'data' => compact('errors')
        ], 422);
        throw new \Illuminate\Validation\ValidationException($validator, $response);
    }
}
