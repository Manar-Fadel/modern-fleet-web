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
        $company = Company::where('user_id', \auth()->id())->first();
        return view('web.profile.index',  compact('company'));
    }
    public function saveProfile(UpdateProfileRequest $request): \Illuminate\Http\RedirectResponse
    {
        \auth()->user()->update([
            'full_name' => $request->input('full_name'),
            'tax_number' => $request->input('tax_number')
        ]);

        if (\auth()->user()->type == Constants::COMPANY) {
            $company = Company::where('user_id', \auth()->id())->first();
            if (!$company instanceof Company) {
                $company = new Company();
                $company->user_id = \auth()->id();
            }
            $company->company_name = $request->input('full_name');
            $company->tax_number = $request->input('tax_number');

            if ($request->has('trade_license_file')) {
                $doc_path = AdminManager::uploadImageFile($request->file('trade_license_file'), 'uploads/companies/');
                $company->trade_license_file = $doc_path;
            }
            if ($request->has('vat_certificate_file')) {
                $doc_path = AdminManager::uploadImageFile($request->file('vat_certificate_file'), 'uploads/companies/');
                $company->vat_certificate_file = $doc_path;
            }

            if (!$company->save()) {
                return Redirect::back()->with([
                    'error' => Lang::get('web.Error in saving data', [], app()->getLocale())
                ]);
            }
        }

        Session::flash(
            'message',
            Lang::get('web.Profile data updated, admin will review them soon.', [], app()->getLocale()),
        );
        return \redirect()->back();
    }

}
