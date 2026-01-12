<?php
namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreCarRequestQuotationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // اربطه لاحقًا بصلاحيات الأدمن
    }

    public function rules(): array
    {
        return [
            'items' => ['required','array','min:1'],

            //'items.*.item_id' => ['required','exists:car_request_items,id'],
            'items.*.unit_price' => ['required','numeric','min:0'],
            'items.*.total_price' => ['required','numeric','min:0'],
            'items.*.vat_amount' => ['nullable','numeric','min:0'],
            'items.*.total_with_vat' => ['required','numeric','min:0'],
            'items.*.is_with_vat' => ['nullable','boolean'],
            'items.*.description' => ['nullable','string','max:2000'],

            'total_amount' => ['required','numeric','min:0'],
            'vat_amount' => ['nullable','numeric','min:0'],
            'total_with_vat' => ['required','numeric','min:0'],
        ];
    }
}
