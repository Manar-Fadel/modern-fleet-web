<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Managers\AdminManager;
use App\Managers\CarManager;
use App\Managers\HeavyVehicleManager;
use App\Managers\SettingsManager;
use App\Models\EquipmentBrand;
use App\Models\ContactUsForm;
use App\Models\HeavyVehicle;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        // pass 123456, manar@admin.com
        $local = app()->getLocale();
        $car_categories = CarManager::getCategoriesList();
        $years = AdminManager::getYearsAsArray();

        $heavy_vehicles_categories_with_vehicles = HeavyVehicleManager::getCategoriesWithMainVehicles();
        $brands = EquipmentBrand::main()->take(7)->get();

        $stock_cars = CarManager::getMain();
        $cars_brands_list = AdminManager::getBrandsAsArray('cars');
        $heavy_vehicles_brands_list = AdminManager::getBrandsAsArray('heavy_vehicles');

        $about_us_title = $local == 'ar' ? SettingsManager::getSettingsValueByKey('ABOUT_US_TITLE_AR') : SettingsManager::getSettingsValueByKey('ABOUT_US_TITLE_EN');
        $about_us_text = $local == 'ar' ? SettingsManager::getSettingsValueByKey('ABOUT_US_TEXT_AR') : SettingsManager::getSettingsValueByKey('ABOUT_US_TEXT_EN');

        return view('web.index', compact('heavy_vehicles_categories_with_vehicles',
            'brands', 'stock_cars', 'about_us_title', 'about_us_text', 'cars_brands_list',
            'heavy_vehicles_brands_list', 'car_categories', 'years', 'local'
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
        return view("web.contact-us");
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
        $about_us_title = $local == 'ar' ? SettingsManager::getSettingsValueByKey('ABOUT_US_TITLE_AR') : SettingsManager::getSettingsValueByKey('ABOUT_US_TITLE_EN');
        $about_us_text = $local == 'ar' ? SettingsManager::getSettingsValueByKey('ABOUT_US_TEXT_AR') : SettingsManager::getSettingsValueByKey('ABOUT_US_TEXT_EN');

        return view("web.about-us", compact(
            'local', 'about_us_title', 'about_us_text'
        ));
    }

}
