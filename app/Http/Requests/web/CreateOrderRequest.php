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
        //$data = $this->request->all(); // $data['vin_number']
            return [
                'brand_id' => 'required|exists:brands,id',
                'model_id' => 'required|exists:brand_models,id',
                'manufacturing_year_id' => 'required|exists:manufacturing_years,id',
                'quantity' => 'required|integer',
                'description' => 'required|string|max:500',

                'images' => 'nullable|array',
                'images.*' => 'file|mimes:jpg,jpeg,png|max:5048',
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
