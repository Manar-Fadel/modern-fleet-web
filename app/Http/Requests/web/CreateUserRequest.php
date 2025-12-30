<?php

namespace App\Http\Requests\web;

use App\Managers\Constants;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CreateUserRequest extends FormRequest
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
        $user_type = $request->get("user_type");
        if ($user_type == Constants::DEALER){
            return [
                'full_name' => 'required|string|max:255',
                'id_number' => 'required|string|max:20|unique:users,id_number',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:4',
                'password_confirmation' => 'required|string|min:4|same:password',
                'phone_number' => 'required|unique:users|string|max:20',
                'user_type' => 'required|in:' . Constants::BANK_DELEGATE . ',' . Constants::DEALER,
                'document_url' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,pdf,doc,JPG|max:9048',
                'showroom_doc' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,pdf,doc,JPG|max:9048',
                'commercial_registry_doc' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,pdf,doc,JPG|max:9048',
                'tax_certificate_doc' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,pdf,doc,JPG|max:9048',
                'national_address_certificate_doc' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,pdf,doc,JPG|max:9048',
                'representative_authorization_doc' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,pdf,doc,JPG|max:9048',
                ];
        }else{
            return [
                'full_name' => 'required|string|max:255',
                'id_number' => 'required|string|max:20|unique:users,id_number',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:4',
                'password_confirmation' => 'required|string|min:4|same:password',
                'phone_number' => 'required|unique:users|string|max:20',
                'user_type' => 'required|in:' . Constants::BANK_DELEGATE . ',' . Constants::DEALER,
                'document_url' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,pdf,doc,JPG,|max:9048',
                'business_card_image' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,pdf,doc,JPG|max:9048',
            ];
        }

    }


}
