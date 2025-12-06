<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\BrandModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandsModelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $modelsByBrand = [
            'Caterpillar' => [
                ['320D', '320 دي'],
                ['320GC', '320 جي سي'],
                ['330D', '330 دي'],
                ['336D', '336 دي'],
                ['950G', '950 جي'],
                ['966H', '966 اتش'],
                ['D6R', 'دي 6 آر'],
                ['D8T', 'دي 8 تي'],
            ],

            'Komatsu' => [
                ['PC200', 'بي سي 200'],
                ['PC210', 'بي سي 210'],
                ['PC300', 'بي سي 300'],
                ['WA380', 'دبليو ايه 380'],
                ['WA470', 'دبليو ايه 470'],
                ['D65', 'دي 65'],
            ],

            'Volvo CE' => [
                ['EC210', 'اي سي 210'],
                ['EC240', 'اي سي 240'],
                ['EC480', 'اي سي 480'],
                ['L90', 'ال 90'],
                ['L120', 'ال 120'],
            ],

            'Hitachi' => [
                ['ZX200', 'زد اكس 200'],
                ['ZX210', 'زد اكس 210'],
                ['ZX350', 'زد اكس 350'],
                ['ZW220', 'زدبليو 220'],
            ],

            'Mercedes-Benz Trucks' => [
                ['Actros', 'أكتروس'],
                ['Arocs', 'أروكس'],
                ['Axor', 'أكسور'],
            ],

            'Scania' => [
                ['R450', 'آر 450'],
                ['R500', 'آر 500'],
                ['G410', 'جي 410'],
            ],

            'Volvo Trucks' => [
                ['FH12', 'اف اتش 12'],
                ['FH16', 'اف اتش 16'],
                ['FMX', 'اف ام اكس'],
            ],

            'MAN' => [
                ['TGX', 'تي جي اكس'],
                ['TGS', 'تي جي اس'],
            ],

            'Isuzu' => [
                ['NQR', 'ان كيو آر'],
                ['FTR', 'اف تي آر'],
                ['FVR', 'اف في آر'],
            ],

            'JCB' => [
                ['3CX', '3 سي اكس'],
                ['4CX', '4 سي اكس'],
            ],
        ];

        foreach ($modelsByBrand as $brandName => $models) {
            $brand = Brand::where('name_en', $brandName)->first();

            if (!$brand) {
                continue;
            }

            foreach ($models as $model) {
                BrandModel::updateOrCreate(
                    [
                        'brand_id' => $brand->id,
                        'name_en'  => $model[0],
                    ],
                    [
                        'name_ar' => $model[1],
                    ]
                );
            }
        }
    }
}
