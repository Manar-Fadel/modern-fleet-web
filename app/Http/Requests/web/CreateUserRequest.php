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
        $user_type = $request->get("type");
        if ($user_type == Constants::COMPANY){
            return [
                'full_name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:4',
                'password_confirmation' => 'required|string|min:4|same:password',
                'phone_number' => 'required|unique:users|string|max:20',
                'type' => 'required|in:' . Constants::CUSTOMER . ',' . Constants::COMPANY,
                'tax_number' => 'nullable|string|max:20',
                'trade_license_file' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,pdf,doc,JPG|max:9048',
                'vat_certificate_file' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,pdf,doc,JPG|max:9048',
                ];
        }else{
            return [
                'full_name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:4',
                'password_confirmation' => 'required|string|min:4|same:password',
                'phone_number' => 'required|unique:users|string|max:20',
                'type' => 'required|in:' . Constants::CUSTOMER . ',' . Constants::COMPANY,
            ];
        }

    }


}
