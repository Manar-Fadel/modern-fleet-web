<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HeavyVehicleRequest extends FormRequest
{
    public function authorize(): bool
    {
        // عدّلها حسب نظام الصلاحيات عندك
        return true;
    }

    public function rules(): array
    {
        return [
            'brand_id'              => ['required', 'exists:brands,id'],
            'model_id'              => ['required', 'exists:brand_models,id'],
            'manufacturing_year_id' => ['nullable', 'exists:manufacturing_years,id'],
            'category_id'           => ['required', 'exists:heavy_vehicle_categories,id'],

            'condition'             => ['required', 'in:new,used,refurbished'],
            'location'              => ['nullable', 'string', 'max:255'],
            'fuel_type'             => ['nullable', 'string', 'max:100'],
            'engine_power'          => ['nullable', 'integer', 'min:0'],
            'operating_weight'                => ['nullable', 'integer', 'min:0'],
            'bucket_capacity'              => ['nullable', 'integer', 'min:0'],
            'lifting_capacity'       => ['nullable', 'integer', 'min:0'],
            'payload_capacity'       => ['nullable', 'integer', 'min:0'],
            'transmission'          => ['nullable', 'string', 'max:100'],
            'mileage'               => ['nullable', 'numeric', 'min:0'],
            'origin'                => ['nullable', 'string', 'max:100'],
            'description'           => ['nullable', 'string'],

            'images'   => ['nullable', 'array'],
            'images.*' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:4096'],
        ];
    }
}
