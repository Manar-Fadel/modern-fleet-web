<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HeavyVehicle;
use App\Models\HeavyVehicleCategory;
use App\Models\HeavyVehicleImage;
use Illuminate\Support\Str;

class HeavyVehiclesSeeder extends Seeder
{
    public function run(): void
    {
        $categories = HeavyVehicleCategory::take(6)->get();

        if ($categories->count() === 0) {
            $this->command->warn('No HeavyVehicleCategories found.');
            return;
        }

        foreach ($categories as $category) {

            // 5 vehicles per category
            for ($i = 1; $i <= 5; $i++) {

                $vehicle = HeavyVehicle::create([
                    'category_id' => $category->id,
                    'brand_id' => rand(1, 5), // عدّل حسب بياناتك
                    'model_id' => rand(1, 20),
                    'manufacturing_year_id' => rand(1, 30),

                    'condition' => ['new', 'used'][array_rand(['new', 'used'])],
                    'engine_power' => rand(150, 600),
                    'transmission_type' => 'Automatic',
                    'operating_weight' =>rand(5000, 45000),
                    'bucket_capacity' => rand(10, 50),
                    'lifting_capacity' => rand(10, 99990),
                    'fuel_type' => 'Petrol',
                    'boom_length' => rand(1000, 900000),
                    'drum_width' => rand(1000, 900000),
                    'location' => 'Riyadh',
                    'price' => rand(250000, 1500000),
                    'is_main' => true,

                    'description' => 'High-performance heavy vehicle suitable for industrial and construction use.',
                ]);

            }
        }

        $this->command->info('Heavy vehicles seeded successfully.');
    }
}
