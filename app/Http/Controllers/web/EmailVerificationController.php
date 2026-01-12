<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Managers\SettingsManager;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class EmailVerificationController extends Controller
{
    public function notice(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $local = app()->getLocale();
        $customer_care_mobile = SettingsManager::getSettingsValueByKey('CUSTOMER_CARE_MOBILE');
        $customer_care_email = SettingsManager::getSettingsValueByKey('CUSTOMER_CARE_EMAIL');
        $location = $local == 'ar' ? SettingsManager::getSettingsValueByKey('LOCATION_AR') : SettingsManager::getSettingsValueByKey('LOCATION_EN');

        return view('web.auth.verify-email', compact(
            'customer_care_mobile', 'local',
            'customer_care_email', 'location'
        ));
    }
    public function verify(EmailVerificationRequest $request): \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        $request->fulfill();
        return redirect('/');
    }
    public function send(Request $request): \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', Lang::get('web.Verification link sent!', [], app()->getLocale()));
    }

}
