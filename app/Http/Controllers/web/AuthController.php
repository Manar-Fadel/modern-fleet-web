<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\web\CreateUserRequest;
use App\Http\Requests\web\UpdateProfileRequest;
use App\Jobs\SendVerifyEmailAddressEmailJob;
use App\Managers\AdminManager;
use App\Managers\Constants;
use App\Managers\SettingsManager;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index(Request $request): \Illuminate\Http\RedirectResponse|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        if ($request->isMethod('POST')) {
            $user = User::whereIn('type', [Constants::CUSTOMER, Constants::COMPANY])
                ->where('email', $request->get('email'))
                ->first();
            if (!$user instanceof User) {
                return Redirect::back()->with([
                    'error' => Lang::get('web.Error in email or password', [], app()->getLocale()),
                ]);
            }

            if (!$user || ! Hash::check($request->get('password'), $user->password)) {
                return Redirect::back()->with([
                    'error' => Lang::get('web.Error in email or password', [], app()->getLocale()),
                ]);

            } else {
                Auth::login($user);
                $token = $user->createToken('MyApp')->plainTextToken;
                Session::put('auth_token', $token);

                if (!$user->email_verified_at) {
                    return Redirect::route('verification.notice');
                }else {
                    return Redirect::route('order-now');
                }
            }

        } else {
            return view('web.auth.login');
        }
    }
    public function register(): \Illuminate\Http\RedirectResponse|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        return view('web.auth.register');

    }
    public function postRegister(CreateUserRequest $request): \Illuminate\Http\RedirectResponse|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        $user = User::create([
            'full_name' => $request->input('full_name'),
            'phone_number' => $request->input('phone_number'),
            'type' => $request->input('type'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        if (!$user instanceof User) {
            return Redirect::back()->with([
                'error' => Lang::get('web.Error in saving data', [], app()->getLocale())
            ]);
        }

        if ($request->input('type') == Constants::COMPANY) {
            $company = new Company();
            $company->user_id = $user->id;
            $company->company_name = $request->input('full_name');
            $company->tax_number =  $request->input('tax_number');

            if ($request->has('trade_license_file')) {
                $doc_path = AdminManager::uploadImageFile($request->file('trade_license_file'), 'uploads/companies/');
                $company->trade_license_file = $doc_path;
            }
            if ($request->has('vat_certificate_file')) {
                $doc_path = AdminManager::uploadImageFile($request->file('vat_certificate_file'), 'uploads/companies/');
                $company->vat_certificate_file = $doc_path;
            }

            if (!$company->save()){
                return Redirect::back()->with([
                    'error' => Lang::get('web.Error in saving data', [], app()->getLocale())
                ]);
            }
        }
        Auth::login($user);
        $token = $user->createToken('MyApp')->plainTextToken;
        Session::put('auth_token', $token);
        SendVerifyEmailAddressEmailJob::dispatch($user);

        Session::flash(
            'message',
            Lang::get('web.Email verification link sent to your email address, please check your email', [], app()->getLocale()),
        );

        return Redirect::route('verification.notice');
    }
    public function logout(): \Illuminate\Http\RedirectResponse
    {
        Auth::guard('web')->logout();
        return \redirect()->route('login');
    }

    public function profile(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $local = app()->getLocale();
        $customer_care_mobile = SettingsManager::getSettingsValueByKey('CUSTOMER_CARE_MOBILE');
        $customer_care_email = SettingsManager::getSettingsValueByKey('CUSTOMER_CARE_EMAIL');
        $location = $local == 'ar' ? SettingsManager::getSettingsValueByKey('LOCATION_AR') : SettingsManager::getSettingsValueByKey('LOCATION_EN');

        return view('web.profile.index', compact( 'local',
            'customer_care_mobile',  'customer_care_email', 'location'
        ));
    }
    public function saveProfile(UpdateProfileRequest $request): \Illuminate\Http\RedirectResponse
    {
        $user = \auth()->user();
        $user->update([
            'full_name' => $request->input('full_name'),
            'shop_name' => $request->input('shop_name'),
            //'id_number' => $request->input('id_number'),
            //'email' => $request->input('email'),
            //'phone_number' => $request->input('phone_number'),
        ]);

        if ($request->has('showroom_doc')) {
            $doc_path = AdminManager::uploadImageFile($request->file('showroom_doc'), 'uploads/dealers/showroom_docs/');
            $user->showroom_doc = $doc_path;
            $user->save();
        }
        if ($request->has('document_url')) {
            $doc_path = AdminManager::uploadImageFile($request->file('document_url'), 'uploads/users/document_urls/');
            $user->document_url = $doc_path;
            $user->save();
        }
        if ($request->has('business_card_image')) {
            $doc_path = AdminManager::uploadImageFile($request->file('business_card_image'), 'uploads/bank-delegates/business_cards/');
            $user->business_card_image = $doc_path;
            $user->save();
        }
        if ($request->has('tax_certificate_doc')) {
            $doc_path = AdminManager::uploadImageFile($request->file('tax_certificate_doc'), 'uploads/users/tax_certificate/');
            $user->tax_certificate_doc = $doc_path;
            $user->save();
        }
        if ($request->has('national_address_certificate_doc')) {
            $doc_path = AdminManager::uploadImageFile($request->file('national_address_certificate_doc'), 'uploads/users/national_address_certificate/');
            $user->national_address_certificate_doc = $doc_path;
            $user->save();
        }
        if ($request->has('commercial_registry_doc')) {
            $doc_path = AdminManager::uploadImageFile($request->file('commercial_registry_doc'), 'uploads/users/commercial_registry/');
            $user->commercial_registry_doc = $doc_path;
            $user->save();
        }
        if ($request->has('representative_authorization_doc')) {
            $doc_path = AdminManager::uploadImageFile($request->file('representative_authorization_doc'), 'uploads/users/representative_authorization/');
            $user->representative_authorization_doc = $doc_path;
            $user->save();
        }

        Session::flash(
            'message',
            Lang::get('web.Profile data updated, admin will review them soon.', [], app()->getLocale()),
        );
        return \redirect()->back();
    }

}
