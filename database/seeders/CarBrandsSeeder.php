<?php

namespace Database\Seeders;

use App\Models\EquipmentBrand;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CarBrandsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            // 🚗 Japanese
            ['name_en' => 'Toyota', 'name_ar' => 'تويوتا'],
            ['name_en' => 'Nissan', 'name_ar' => 'نيسان'],
            ['name_en' => 'Honda', 'name_ar' => 'هوندا'],
            ['name_en' => 'Mazda', 'name_ar' => 'مازدا'],
            ['name_en' => 'Mitsubishi', 'name_ar' => 'ميتسوبيشي'],
            ['name_en' => 'Subaru', 'name_ar' => 'سوبارو'],
            ['name_en' => 'Suzuki', 'name_ar' => 'سوزوكي'],
            ['name_en' => 'Lexus', 'name_ar' => 'لكزس'],

            // 🚙 Korean
            ['name_en' => 'Hyundai', 'name_ar' => 'هيونداي'],
            ['name_en' => 'Kia', 'name_ar' => 'كيا'],
            ['name_en' => 'Genesis', 'name_ar' => 'جينيسيس'],

            // 🚘 German
            ['name_en' => 'Mercedes-Benz', 'name_ar' => 'مرسيدس بنز'],
            ['name_en' => 'BMW', 'name_ar' => 'بي إم دبليو'],
            ['name_en' => 'Audi', 'name_ar' => 'أودي'],
            ['name_en' => 'Volkswagen', 'name_ar' => 'فولكس فاجن'],
            ['name_en' => 'Porsche', 'name_ar' => 'بورش'],

            // 🚗 American
            ['name_en' => 'Ford', 'name_ar' => 'فورد'],
            ['name_en' => 'Chevrolet', 'name_ar' => 'شفروليه'],
            ['name_en' => 'GMC', 'name_ar' => 'جي إم سي'],
            ['name_en' => 'Tesla', 'name_ar' => 'تسلا'],
            ['name_en' => 'Dodge', 'name_ar' => 'دودج'],
            ['name_en' => 'Jeep', 'name_ar' => 'جيب'],

            // 🚘 European
            ['name_en' => 'Peugeot', 'name_ar' => 'بيجو'],
            ['name_en' => 'Renault', 'name_ar' => 'رينو'],
            ['name_en' => 'Citroën', 'name_ar' => 'سيتروين'],
            ['name_en' => 'Fiat', 'name_ar' => 'فيات'],
            ['name_en' => 'Skoda', 'name_ar' => 'سكودا'],
            ['name_en' => 'Seat', 'name_ar' => 'سيات'],
            ['name_en' => 'Volvo', 'name_ar' => 'فولفو'],

            // 🚙 Chinese
            ['name_en' => 'Chery', 'name_ar' => 'شيري'],
            ['name_en' => 'Geely', 'name_ar' => 'جيلي'],
            ['name_en' => 'BYD', 'name_ar' => 'بي واي دي'],
            ['name_en' => 'Haval', 'name_ar' => 'هافال'],
            ['name_en' => 'MG', 'name_ar' => 'إم جي'],
        ];

        foreach ($brands as $brand) {
            EquipmentBrand::updateOrCreate(
                ['name_en' => $brand['name_en']],
                [
                    'name_ar' => $brand['name_ar'],

                    // ✅ Flags
                    'is_car' => true,
                    'is_heavy_vehicle' => false,

                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]
            );
        }
    }
}
