<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;

class CountriesSeeder extends Seeder
{
    public function run(): void
    {
        $countries = [

            // 🌍 Middle East
            ['PS', 'Palestine', 'فلسطين', '+970'],
            ['SA', 'Saudi Arabia', 'المملكة العربية السعودية', '+966'],
            ['AE', 'United Arab Emirates', 'الإمارات العربية المتحدة', '+971'],
            ['QA', 'Qatar', 'قطر', '+974'],
            ['KW', 'Kuwait', 'الكويت', '+965'],
            ['BH', 'Bahrain', 'البحرين', '+973'],
            ['OM', 'Oman', 'عُمان', '+968'],
            ['JO', 'Jordan', 'الأردن', '+962'],
            ['EG', 'Egypt', 'مصر', '+20'],
            ['IQ', 'Iraq', 'العراق', '+964'],
            ['LB', 'Lebanon', 'لبنان', '+961'],
            ['SY', 'Syria', 'سوريا', '+963'],
            ['YE', 'Yemen', 'اليمن', '+967'],

            // 🌍 Europe
            ['DE', 'Germany', 'ألمانيا', '+49'],
            ['FR', 'France', 'فرنسا', '+33'],
            ['IT', 'Italy', 'إيطاليا', '+39'],
            ['ES', 'Spain', 'إسبانيا', '+34'],
            ['GB', 'United Kingdom', 'المملكة المتحدة', '+44'],
            ['NL', 'Netherlands', 'هولندا', '+31'],
            ['SE', 'Sweden', 'السويد', '+46'],
            ['NO', 'Norway', 'النرويج', '+47'],

            // 🌏 Asia
            ['CN', 'China', 'الصين', '+86'],
            ['JP', 'Japan', 'اليابان', '+81'],
            ['KR', 'South Korea', 'كوريا الجنوبية', '+82'],
            ['IN', 'India', 'الهند', '+91'],
            ['PK', 'Pakistan', 'باكستان', '+92'],
            ['BD', 'Bangladesh', 'بنغلاديش', '+880'],
            ['ID', 'Indonesia', 'إندونيسيا', '+62'],

            // 🌎 Americas
            ['US', 'United States', 'الولايات المتحدة', '+1'],
            ['CA', 'Canada', 'كندا', '+1'],
            ['BR', 'Brazil', 'البرازيل', '+55'],
            ['MX', 'Mexico', 'المكسيك', '+52'],

            // 🌍 Africa
            ['ZA', 'South Africa', 'جنوب أفريقيا', '+27'],
            ['NG', 'Nigeria', 'نيجيريا', '+234'],
            ['MA', 'Morocco', 'المغرب', '+212'],
            ['DZ', 'Algeria', 'الجزائر', '+213'],
            ['TN', 'Tunisia', 'تونس', '+216'],
        ];

        foreach ($countries as $country) {
            Country::updateOrCreate(
                ['iso_code' => $country[0]],
                [
                    'name_en'    => $country[1],
                    'name_ar'    => $country[2],
                    'phone_code' => $country[3],
                ]
            );
        }
    }
}
