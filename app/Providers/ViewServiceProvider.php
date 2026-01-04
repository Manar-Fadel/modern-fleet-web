<?php

namespace App\Providers;

use App\Managers\SettingsManager;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\HeavyVehicleCategory;
use App\Models\EquipmentBrand;

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Header + Footer data
        View::composer(
            ['web.includes.header', 'web.includes.mobile-header', 'web.includes.footer'], // 'web.includes.about',  'web.includes.contact'
            function ($view) {
                $view->with([
                    'local' => app()->getLocale(),
                    'customer_care_mobile' => SettingsManager::getSettingsValueByKey('CUSTOMER_CARE_MOBILE'),
                    'customer_care_email' => SettingsManager::getSettingsValueByKey('CUSTOMER_CARE_EMAIL'),
                    'location' => app()->getLocale() == 'ar' ? SettingsManager::getSettingsValueByKey('LOCATION_AR') : SettingsManager::getSettingsValueByKey('LOCATION_EN'),
                ]);
            }
        );
    }
}
