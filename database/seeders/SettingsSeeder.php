<?php

namespace Database\Seeders;

use App\Models\Settings;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Settings::updateOrCreate(
            ['code_key' => 'CUSTOMER_CARE_MOBILE'],
            [   'name_ar' => 'رقم التواصل مع الدعم الفني',
                'name_en' => 'Customer Care mobile',
                'vale' => '+966 50 172 8262',
                'created_at' => now(),
                'updated_at' => now()
        ]);
        Settings::updateOrCreate(
            ['code_key' => 'CUSTOMER_CARE_EMAIL'],
            [   'name_ar' => 'ايميل التواصل مع الدعم الفني',
                'name_en' => 'Customer Care email',
                'vale' => 'customer.care@modernfleet.sa',
                'created_at' => now(),
                'updated_at' => now()
        ]);
        Settings::updateOrCreate(
            ['code_key' => 'LOCATION_AR'],
            [   'name_ar' => 'العنوان بالعربية',
                'name_en' => 'Location in Arabic',
                'vale' => '280 Augusta Avenue, M5T 2L9 Toronto, Canada',
                'created_at' => now(),
                'updated_at' => now()
        ]);
        Settings::updateOrCreate(
            ['code_key' => 'LOCATION_EN'],
            [   'name_ar' => 'العنوان بالانجليزية',
                'name_en' => 'Location in English',
                'vale' => '280 Augusta Avenue, M5T 2L9 Toronto, Canada',
                'created_at' => now(),
                'updated_at' => now()
            ]);
        Settings::updateOrCreate(
            ['code_key' => 'ABOUT_US_TITLE_AR'],
            [   'name_ar' => 'عنوان من نحن بالعربية',
                'name_en' => 'About us address in Arabic',
                'vale' => 'رادارك الذكي للسيارات',
                'created_at' => now(),
                'updated_at' => now()
        ]);
        Settings::updateOrCreate(
            ['code_key' => 'ABOUT_US_TITLE_EN'],
            [   'name_ar' => 'عنوان من نحن بالانجليزية',
                'name_en' => 'Abount us address in English',
                'vale' => 'Your Smart Modern Fleet',
                'created_at' => now(),
                'updated_at' => now()
        ]);
        Settings::updateOrCreate(
            ['code_key' => 'ABOUT_US_TEXT_AR'],
            [   'name_ar' => 'عنوان من نحن بالعربية',
                'name_en' => 'About us address in Arabic',
                'vale' => 'test test test',
                'created_at' => now(),
                'updated_at' => now()
        ]);
        Settings::updateOrCreate(
            ['code_key' => 'ABOUT_US_TEXT_EN'],
            [   'name_ar' => 'عنوان من نحن بالانجليزية',
                'name_en' => 'About us address in English',
                'vale' => 'Your Smart Car Radar',
                'created_at' => now(),
                'updated_at' => now()
        ]);
    }
}
