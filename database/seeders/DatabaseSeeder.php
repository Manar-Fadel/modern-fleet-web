<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            SettingsSeeder::class,

            UserSeeder::class,

            CountriesSeeder::class,
            CitiesSeeder::class,

            BrandsSeeder::class,
            BrandsModelsSeeder::class,
            CarBrandsSeeder::class,
            CarBrandModelsSeeder::class,
            ManufacturingYearsSeeder::class,

            HeavyVehicleCategorySeeder::class,
            HeavyVehiclesSeeder::class,

            CarCategoriesSeeder::class,
            CarsSeeder::class,
        ]);

    }
}
