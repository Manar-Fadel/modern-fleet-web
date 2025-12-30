<?php

namespace App\Http\Requests\web;

use App\Managers\Constants;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(Request $request): array
    {
        return [
            'full_name' => 'required|string|max:255',
            'document_url' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,pdf,doc,JPG|max:9048',
            'showroom_doc' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,pdf,doc,JPG|max:9048',
            'commercial_registry_doc' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,pdf,doc,JPG|max:9048',
            'tax_certificate_doc' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,pdf,doc,JPG|max:9048',
            'national_address_certificate_doc' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,pdf,doc,JPG|max:9048',
            'representative_authorization_doc' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,pdf,doc,JPG|max:9048',
            'business_card_image' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,pdf,doc,JPG|max:9048',
        ];
    }


}
