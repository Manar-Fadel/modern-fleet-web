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
                'value' => '+966 50 172 8262',
                'created_at' => now(),
                'updated_at' => now()
        ]);
        Settings::updateOrCreate(
            ['code_key' => 'CUSTOMER_CARE_EMAIL'],
            [   'name_ar' => 'ايميل التواصل مع الدعم الفني',
                'name_en' => 'Customer Care email',
                'value' => 'customer.care@modernfleet.sa',
                'created_at' => now(),
                'updated_at' => now()
        ]);
        Settings::updateOrCreate(
            ['code_key' => 'LOCATION_AR'],
            [   'name_ar' => 'العنوان بالعربية',
                'name_en' => 'Location in Arabic',
                'value' => '280 Augusta Avenue, M5T 2L9 Toronto, Canada',
                'created_at' => now(),
                'updated_at' => now()
        ]);
        Settings::updateOrCreate(
            ['code_key' => 'LOCATION_EN'],
            [   'name_ar' => 'العنوان بالانجليزية',
                'name_en' => 'Location in English',
                'value' => '280 Augusta Avenue, M5T 2L9 Toronto, Canada',
                'created_at' => now(),
                'updated_at' => now()
            ]);
        Settings::updateOrCreate(
            ['code_key' => 'ABOUT_US_TITLE_AR'],
            [   'name_ar' => 'عنوان من نحن بالعربية',
                'name_en' => 'مودرن فليت… تجربة ذكية لعالم المركبات',
                'value' => 'رادارك الذكي للسيارات',
                'created_at' => now(),
                'updated_at' => now()
        ]);
        Settings::updateOrCreate(
            ['code_key' => 'ABOUT_US_TITLE_EN'],
            [   'name_ar' => 'عنوان من نحن بالانجليزية',
                'name_en' => 'Modern Fleet… Where Your Journey Begins with Confidence',
                'value' => 'Your Smart Modern Fleet',
                'created_at' => now(),
                'updated_at' => now()
        ]);
        Settings::updateOrCreate(
            ['code_key' => 'ABOUT_US_TEXT_AR'],
            [   'name_ar' => 'نص من نحن بالعربية',
                'name_en' => 'About us text in Arabic',
                'value' => 'نحن منصة رقمية متخصصة في توفير المركبات والمعدات للشركات والأفراد،
نربطك مباشرة بأفضل الخيارات في السوق عبر تجربة سهلة، موثوقة، وشفافة.
من السيارات اليومية إلى أساطيل الأعمال والمعدات الثقيلة،
نقدّم حلولًا ذكية تساعدك على اتخاذ القرار الصحيح والانطلاق بثقة على الطريق.',
                'created_at' => now(),
                'updated_at' => now()
        ]);
        Settings::updateOrCreate(
            ['code_key' => 'ABOUT_US_TEXT_EN'],
            [   'name_ar' => 'نص من نحن بالانجليزية',
                'name_en' => 'About us text in English',
                'value' => 'We are a digital platform specialized in providing vehicles and equipment for businesses and individuals.
We connect you directly with the best market options through a simple, reliable, and transparent experience.
From everyday cars to business fleets and heavy equipment,
we deliver smart solutions that help you make the right decision and move forward with confidence.',
                'created_at' => now(),
                'updated_at' => now()
        ]);
    }
}
