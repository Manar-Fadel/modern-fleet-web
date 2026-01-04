<?php

namespace Database\Seeders;

use App\Models\EquipmentModel;
use Illuminate\Database\Seeder;
use App\Models\EquipmentBrand;
use App\Models\BrandModel;
use Carbon\Carbon;

class CarBrandModelsSeeder extends Seeder
{
    public function run(): void
    {
        $carBrands = EquipmentBrand::where('is_car', true)->get();

        if ($carBrands->isEmpty()) {
            $this->command->warn('No car brands found.');
            return;
        }

        $models = [

            // 🇯🇵 Toyota
            'Toyota' => [
                'Corolla', 'Camry', 'Yaris', 'Avalon', 'Land Cruiser',
                'Prado', 'Hilux', 'Fortuner'
            ],

            // 🇯🇵 Nissan
            'Nissan' => [
                'Sunny', 'Altima', 'Maxima', 'Patrol',
                'X-Trail', 'Pathfinder', 'Navara'
            ],

            // 🇯🇵 Honda
            'Honda' => [
                'Civic', 'Accord', 'City', 'CR-V',
                'HR-V', 'Pilot', 'Odyssey'
            ],

            // 🇯🇵 Mazda
            'Mazda' => [
                'Mazda 2', 'Mazda 3', 'Mazda 6',
                'CX-3', 'CX-5', 'CX-9', 'BT-50'
            ],

            // 🇯🇵 Mitsubishi
            'Mitsubishi' => [
                'Lancer', 'Outlander', 'Pajero',
                'ASX', 'Attrage', 'Eclipse Cross', 'Montero'
            ],

            // 🇰🇷 Hyundai
            'Hyundai' => [
                'Accent', 'Elantra', 'Sonata', 'Azera',
                'Tucson', 'Santa Fe', 'Palisade', 'Creta'
            ],

            // 🇰🇷 Kia
            'Kia' => [
                'Picanto', 'Rio', 'Cerato', 'Optima',
                'Sportage', 'Sorento', 'Telluride'
            ],

            // 🇩🇪 Mercedes-Benz
            'Mercedes-Benz' => [
                'A-Class', 'C-Class', 'E-Class', 'S-Class',
                'GLA', 'GLC', 'GLE', 'GLS'
            ],

            // 🇩🇪 BMW
            'BMW' => [
                '1 Series', '3 Series', '5 Series',
                '7 Series', 'X1', 'X3', 'X5', 'X7'
            ],

            // 🇩🇪 Audi
            'Audi' => [
                'A3', 'A4', 'A6', 'A8',
                'Q3', 'Q5', 'Q7', 'Q8'
            ],

            // 🇺🇸 Ford
            'Ford' => [
                'Fiesta', 'Focus', 'Fusion',
                'Escape', 'Explorer', 'Edge', 'Mustang'
            ],

            // 🇺🇸 Chevrolet
            'Chevrolet' => [
                'Spark', 'Cruze', 'Malibu',
                'Impala', 'Equinox', 'Tahoe', 'Suburban'
            ],

            // 🇸🇪 Volvo
            'Volvo' => [
                'S60', 'S90', 'V60',
                'XC40', 'XC60', 'XC90', 'C40'
            ],

            // 🇨🇳 Chinese Brands
            'Chery' => ['Arrizo 5', 'Arrizo 8', 'Tiggo 2', 'Tiggo 4', 'Tiggo 7', 'Tiggo 8', 'Omoda 5'],
            'Geely' => ['Emgrand', 'Coolray', 'Azkarra', 'Monjaro', 'Tugella', 'GX3', 'Okavango'],
            'MG' => ['MG5', 'MG6', 'ZS', 'HS', 'RX5', 'RX8', 'GT'],
        ];

        foreach ($models as $brandName => $brandModels) {

            $brand = $carBrands->firstWhere('name_en', $brandName);

            if (!$brand) {
                $this->command->warn("Brand not found: {$brandName}");
                continue;
            }

            foreach ($brandModels as $modelName) {
                EquipmentModel::updateOrCreate(
                    [
                        'brand_id' => $brand->id,
                        'name_en' => $modelName,
                    ],
                    [
                        'name_ar' => $modelName, // ممكن تعرّبه لاحقًا
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]
                );
            }
        }

        $this->command->info('Car brand models seeded successfully.');
    }
}
