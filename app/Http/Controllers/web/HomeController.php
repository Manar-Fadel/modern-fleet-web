<?php

namespace App\Http\Controllers\web;

use App\Managers\SettingsManager;
use App\Models\EquipmentBrand;
use App\Models\ContactUsForm;
use App\Models\HeavyVehicle;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class HomeController
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        // pass 123456, manar@admin.com
        $local = app()->getLocale();
        $customer_care_mobile = SettingsManager::getSettingsValueByKey('CUSTOMER_CARE_MOBILE');
        $customer_care_email = SettingsManager::getSettingsValueByKey('CUSTOMER_CARE_EMAIL');
        $location = $local == 'ar' ? SettingsManager::getSettingsValueByKey('LOCATION_AR') : SettingsManager::getSettingsValueByKey('LOCATION_EN');

        $slider_banners = Car::where('is_slider_banner', 1)->orderBy('id', 'DESC')->has('brand')->has('carModel')->take(3)->get();
        $brands = EquipmentBrand::where('is_main', 1)->take(10)->get();
        $best_cars = Car::where('is_best_car', 1)->orderBy('id', 'DESC')->take(10)->get();

        $about_us_title = $local == 'ar' ? SettingsManager::getSettingsValueByKey('ABOUT_US_TITLE_AR') : SettingsManager::getSettingsValueByKey('ABOUT_US_TITLE_EN');
        $about_us_text = $local == 'ar' ? SettingsManager::getSettingsValueByKey('ABOUT_US_TEXT_AR') : SettingsManager::getSettingsValueByKey('ABOUT_US_TEXT_EN');

        return view('web.index', compact( 'local',
            'customer_care_mobile',  'customer_care_email', 'location',
            'slider_banners', 'brands', 'best_cars',
            'about_us_title', 'about_us_text'
        ));
    }
    public function changeLanguage(): \Illuminate\Http\RedirectResponse
    {
        $language = app()->getLocale() == 'ar' ? 'en' : 'ar';
        app()->setLocale($language);
        if (auth()->check()){
            auth()->user()->update(['language' => $language]);
        }
        Session::put('language', $language);
        return redirect()->back();
    }
    public function contactUs(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $local = app()->getLocale();
        $customer_care_mobile = SettingsManager::getSettingsValueByKey('CUSTOMER_CARE_MOBILE');
        $customer_care_email = SettingsManager::getSettingsValueByKey('CUSTOMER_CARE_EMAIL');
        $location = $local == 'ar' ? SettingsManager::getSettingsValueByKey('LOCATION_AR') : SettingsManager::getSettingsValueByKey('LOCATION_EN');

        return view("web.contact-us",  compact( 'local', 'customer_care_mobile', 'customer_care_email', 'location'));
    }
    public function saveContactUs(Request $request): \Illuminate\Http\RedirectResponse
    {
        $model = new ContactUsForm();
        $model->fill($request->all());
        if ($model->save()){
            Session::flash(
                'message',
                Lang::get('web.Your message has been sent successfully', [], app()->getLocale())
            );
        }else{
            Session::flash('error', 'Something went wrong');
        }

        return redirect()->back();
    }
    public function aboutUs(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $local = app()->getLocale();
        $customer_care_mobile = SettingsManager::getSettingsValueByKey('CUSTOMER_CARE_MOBILE');
        $customer_care_email = SettingsManager::getSettingsValueByKey('CUSTOMER_CARE_EMAIL');
        $location = $local == 'ar' ? SettingsManager::getSettingsValueByKey('LOCATION_AR') : SettingsManager::getSettingsValueByKey('LOCATION_EN');

        $about_us_title = $local == 'ar' ? SettingsManager::getSettingsValueByKey('ABOUT_US_TITLE_AR') : SettingsManager::getSettingsValueByKey('ABOUT_US_TITLE_EN');
        $about_us_text = $local == 'ar' ? SettingsManager::getSettingsValueByKey('ABOUT_US_TEXT_AR') : SettingsManager::getSettingsValueByKey('ABOUT_US_TEXT_EN');

        return view("web.about-us", compact(
            'local', 'customer_care_mobile', 'customer_care_email',
            'location', 'about_us_title', 'about_us_text'
        ));
    }

}
