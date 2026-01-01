<?php

namespace Database\Seeders;

use App\Models\EquipmentBrand;
use App\Models\EquipmentModel;
use Illuminate\Database\Seeder;
use App\Models\Car;
use App\Models\CarCategory;
use App\Models\ManufacturingYear;

class CarsSeeder extends Seeder
{
    public function run(): void
    {
        $categories = CarCategory::all();
        $brands     = EquipmentBrand::all();
        $years      = ManufacturingYear::all();

        if ($categories->isEmpty() || $brands->isEmpty()) {
            $this->command->warn('Missing required data (categories or brands)');
            return;
        }

        foreach ($categories as $category) {

            // 5 cars لكل تصنيف
            for ($i = 1; $i <= 5; $i++) {

                $brand = $brands->random();

                $model = EquipmentModel::where('brand_id', $brand->id)->inRandomOrder()->first();
                $year  = $years->random();

                Car::create([
                    'brand_id' => $brand->id,
                    'model_id' => $model? $model->id : 1,
                    'manufacturing_year_id' => $year->id,
                    'category_id' => $category->id,

                    'condition' => collect(['new', 'used', 'refurbished'])->random(),
                    'fuel_type' => collect(['petrol', 'diesel', 'hybrid', 'electric'])->random(),
                    'transmission' => collect(['automatic', 'manual'])->random(),
                    'drive_type' => collect(['FWD', 'RWD', 'AWD'])->random(),

                    'engine_capacity' => rand(1200, 5000),
                    'engine_power' => rand(90, 450),
                    'mileage' => rand(0, 220000),
                    'doors' => rand(2, 5),
                    'seats' => rand(2, 7),

                    'color' => collect(['White', 'Black', 'Silver', 'Gray', 'Blue', 'Red'])->random(),
                    'origin' => collect(['Japan', 'Germany', 'USA', 'Korea'])->random(),
                    'location' => 'Saudi Arabia',

                    'price' => rand(40000, 350000),
                    'is_with_vat' => rand(0, 1),

                    'description' => 'Well-maintained vehicle with excellent performance, suitable for daily and business use.',
                ]);
            }
        }

        $this->command->info('Cars seeded successfully.');
    }
}
