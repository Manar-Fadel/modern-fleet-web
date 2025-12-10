<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarRequest extends FormRequest
{
    public function authorize(): true
    { return true; }

    public function rules(): array
    {
        return [
            'brand_id' => ['required','exists:brands,id'],
            'model_id' => ['required','exists:brand_models,id'],

            'manufacturing_year_id' => ['nullable','exists:manufacturing_years,id'],
            'category_id' => ['nullable','exists:heavy_vehicle_categories,id'],

            'condition' => ['required'],
            'fuel_type' => ['nullable'],
            'transmission' => ['nullable'],
            'drive_type' => ['nullable'],

            'engine_capacity' => ['nullable','numeric'],
            'engine_power' => ['nullable','numeric'],
            'mileage' => ['nullable','numeric'],

            'doors' => ['nullable','integer'],
            'seats' => ['nullable','integer'],

            'color' => ['nullable'],
            'origin' => ['nullable'],
            'location' => ['nullable'],

            'price' => ['nullable','numeric'],
            'is_with_vat' => ['boolean'],

            'description' => ['nullable','string'],

            'images' => ['nullable','array'],
            'images.*' => ['image','max:4096'],
        ];
    }
}

