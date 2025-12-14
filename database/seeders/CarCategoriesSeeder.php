<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarCategoriesSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name_en' => 'Sedan', 'name_ar' => 'سيدان'],
            ['name_en' => 'Hatchback', 'name_ar' => 'هاتشباك'],
            ['name_en' => 'SUV', 'name_ar' => 'دفع رباعي'],
            ['name_en' => 'Crossover', 'name_ar' => 'كروس أوفر'],
            ['name_en' => 'Coupe', 'name_ar' => 'كوبيه'],
            ['name_en' => 'Convertible', 'name_ar' => 'مكشوفة'],
            ['name_en' => 'Pickup', 'name_ar' => 'بيك أب'],
            ['name_en' => 'Sports Car', 'name_ar' => 'سيارة رياضية'],
            ['name_en' => 'Luxury Car', 'name_ar' => 'سيارة فاخرة'],
            ['name_en' => 'Station Wagon', 'name_ar' => 'ستيشن واجن'],
            ['name_en' => 'Van', 'name_ar' => 'فان'],
            ['name_en' => 'Minivan', 'name_ar' => 'ميني فان / عائلية'],
            ['name_en' => 'Electric Car', 'name_ar' => 'سيارة كهربائية'],
            ['name_en' => 'Hybrid Car', 'name_ar' => 'سيارة هجينة'],
            ['name_en' => 'Off-road / 4x4', 'name_ar' => 'دفع رباعي للطرق الوعرة'],
            ['name_en' => 'Commercial Vehicle', 'name_ar' => 'مركبة تجارية'],
            ['name_en' => 'Taxi', 'name_ar' => 'سيارة أجرة'],
            ['name_en' => 'Delivery Vehicle', 'name_ar' => 'سيارة توصيل'],
            ['name_en' => 'Fleet Vehicle', 'name_ar' => 'سيارة أسطول'],
        ];

        DB::table('car_categories')->insert($categories);
    }
}
