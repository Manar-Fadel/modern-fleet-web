<?php

namespace Database\Seeders;

use App\Models\HeavyVehicleCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HeavyVehicleCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['Excavators', 'حفارات'],
            ['Wheel Loaders', 'شيولات'],
            ['Bulldozers', 'بلدوزرات'],
            ['Backhoe Loaders', 'لودر حفار'],
            ['Dump Trucks', 'شاحنات قلاب'],
            ['Truck Tractors', 'رؤوس تريلا'],
            ['Flatbed Trucks', 'سطحات'],
            ['Crane Trucks', 'شاحنات رافعة'],
            ['Forklifts', 'رافعات شوكية'],
            ['Telehandlers', 'تلسكوبي'],
            ['Motor Graders', 'قريدرات'],
            ['Road Rollers', 'مداحل'],
            ['Asphalt Pavers', 'فرادات أسفلت'],
            ['Concrete Mixers', 'خلاطات خرسانة'],
            ['Concrete Pumps', 'مضخات خرسانة'],
            ['Cranes', 'رافعات'],
            ['Generators', 'مولدات كهرباء'],
            ['Agricultural Tractors', 'جرارات زراعية'],
            ['Lowbed Trailers', 'لوبد'],
            ['Fuel Tankers', 'صهاريج وقود'],
            ['Water Tankers', 'صهاريج مياه'],
            ['Garbage Trucks', 'شاحنات نفايات'],
            ['Buses', 'باصات'],
            ['Mobile Lighting Towers', 'أبراج إنارة'],
        ];

        foreach ($categories as $category) {
            HeavyVehicleCategory::updateOrCreate(
                ['name_en' => $category[0]],
                ['name_ar' => $category[1]]
            );
        }
    }
}
