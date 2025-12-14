<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'brand_id' => ['required','exists:brands,id'],
            'model_id' => ['required','exists:brand_models,id'],
            'manufacturing_year_id' => ['nullable','exists:manufacturing_years,id'],
            'category_id' => ['nullable','exists:heavy_vehicle_categories,id'],

            'condition' => ['required','in:new,used,refurbished'],
            'fuel_type' => ['nullable','string','max:50'],
            'transmission' => ['nullable','string','max:50'],
            'drive_type' => ['nullable','string','max:50'],

            'engine_capacity' => ['nullable','numeric','min:0'],
            'engine_power' => ['nullable','numeric','min:0'],
            'mileage' => ['nullable','numeric','min:0'],
            'doors' => ['nullable','integer','min:0'],
            'seats' => ['nullable','integer','min:0'],

            'color' => ['nullable','string','max:100'],
            'origin' => ['nullable','string','max:100'],
            'location' => ['nullable','string','max:255'],

            'price' => ['nullable','numeric','min:0'],
            'is_with_vat' => ['required','boolean'],

            'description' => ['nullable','string','max:3000'],

            // Images
            'images' => ['nullable','array'],
            'images.*' => ['image','mimes:jpg,jpeg,png,webp','max:4096'],
        ];
    }
}
