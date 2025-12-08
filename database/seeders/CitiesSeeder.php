<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;
use App\Models\City;

class CitiesSeeder extends Seeder
{
    public function run(): void
    {
        $cities = [

            // 🇵🇸 Palestine
            'PS' => [
                ['Jerusalem', 'القدس'],
                ['Gaza', 'غزة'],
                ['Ramallah', 'رام الله'],
                ['Hebron', 'الخليل'],
                ['Nablus', 'نابلس'],
                ['Jenin', 'جنين'],
                ['Tulkarm', 'طولكرم'],
                ['Bethlehem', 'بيت لحم'],
                ['Jericho', 'أريحا'],
            ],

            // 🇸🇦 Saudi Arabia
            'SA' => [
                ['Riyadh', 'الرياض'],
                ['Jeddah', 'جدة'],
                ['Dammam', 'الدمام'],
                ['Mecca', 'مكة'],
                ['Medina', 'المدينة'],
            ],

            // 🇦🇪 UAE
            'AE' => [
                ['Dubai', 'دبي'],
                ['Abu Dhabi', 'أبو ظبي'],
                ['Sharjah', 'الشارقة'],
                ['Ajman', 'عجمان'],
            ],

            // 🇪🇬 Egypt
            'EG' => [
                ['Cairo', 'القاهرة'],
                ['Giza', 'الجيزة'],
                ['Alexandria', 'الإسكندرية'],
                ['Suez', 'السويس'],
            ],

            // 🇯🇴 Jordan
            'JO' => [
                ['Amman', 'عمّان'],
                ['Zarqa', 'الزرقاء'],
                ['Irbid', 'إربد'],
            ],

            // 🇩🇪 Germany
            'DE' => [
                ['Berlin', 'برلين'],
                ['Munich', 'ميونخ'],
                ['Frankfurt', 'فرانكفورت'],
            ],

            // 🇺🇸 United States
            'US' => [
                ['New York', 'نيويورك'],
                ['Los Angeles', 'لوس أنجلوس'],
                ['Chicago', 'شيكاغو'],
            ],

            // 🇮🇳 India
            'IN' => [
                ['New Delhi', 'نيودلهي'],
                ['Mumbai', 'مومباي'],
                ['Bangalore', 'بنغالور'],
            ],
        ];

        foreach ($cities as $countryCode => $cityList) {

            $country = Country::where('iso_code', $countryCode)->first();

            if (!$country) {
                continue;
            }

            foreach ($cityList as $city) {
                City::updateOrCreate(
                    [
                        'country_id' => $country->id,
                        'name_en'    => $city[0],
                    ],
                    [
                        'name_ar' => $city[1],
                    ]
                );
            }
        }
    }
}
