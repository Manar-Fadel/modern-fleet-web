<?php

namespace Database\Seeders;

use App\Models\EquipmentBrand;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            // 🚜 Heavy Equipment & Construction
            ['name_en' => 'Caterpillar', 'name_ar' => 'كاتربيلر'],
            ['name_en' => 'Komatsu', 'name_ar' => 'كوماتسو'],
            ['name_en' => 'Volvo CE', 'name_ar' => 'فولفو معدات ثقيلة'],
            ['name_en' => 'Hitachi', 'name_ar' => 'هيتاشي'],
            ['name_en' => 'Liebherr', 'name_ar' => 'ليبهير'],
            ['name_en' => 'Doosan', 'name_ar' => 'دوسان'],
            ['name_en' => 'Hyundai CE', 'name_ar' => 'هيونداي معدات ثقيلة'],
            ['name_en' => 'JCB', 'name_ar' => 'جي سي بي'],
            ['name_en' => 'CASE', 'name_ar' => 'كيس'],
            ['name_en' => 'John Deere', 'name_ar' => 'جون دير'],
            ['name_en' => 'Terex', 'name_ar' => 'تيريكس'],
            ['name_en' => 'SANY', 'name_ar' => 'ساني'],
            ['name_en' => 'XCMG', 'name_ar' => 'إكس سي إم جي'],
            ['name_en' => 'Zoomlion', 'name_ar' => 'زومليون'],
            ['name_en' => 'Bobcat', 'name_ar' => 'بوبكات'],
            ['name_en' => 'Kubota', 'name_ar' => 'كوبوتا'],
            ['name_en' => 'Takeuchi', 'name_ar' => 'تاكيوشي'],
            ['name_en' => 'Yanmar', 'name_ar' => 'يانمار'],

            // 🚛 Trucks & Heavy Vehicles
            ['name_en' => 'Mercedes-Benz Trucks', 'name_ar' => 'مرسيدس شاحنات'],
            ['name_en' => 'Volvo Trucks', 'name_ar' => 'فولفو شاحنات'],
            ['name_en' => 'MAN', 'name_ar' => 'مان'],
            ['name_en' => 'Scania', 'name_ar' => 'سكانيا'],
            ['name_en' => 'DAF', 'name_ar' => 'داف'],
            ['name_en' => 'Iveco', 'name_ar' => 'إيفيكو'],
            ['name_en' => 'Renault Trucks', 'name_ar' => 'رينو شاحنات'],
            ['name_en' => 'Isuzu', 'name_ar' => 'إيسوزو'],
            ['name_en' => 'Hino', 'name_ar' => 'هينو'],
            ['name_en' => 'UD Trucks', 'name_ar' => 'يو دي شاحنات'],
            ['name_en' => 'Foton', 'name_ar' => 'فوتون'],
            ['name_en' => 'FAW', 'name_ar' => 'فاو'],
            ['name_en' => 'Sinotruk', 'name_ar' => 'سينوتراك'],
            ['name_en' => 'HOWO', 'name_ar' => 'هاوو'],
            ['name_en' => 'Shacman', 'name_ar' => 'شاكمان'],
            ['name_en' => 'Tata Motors', 'name_ar' => 'تاتا'],
            ['name_en' => 'Ashok Leyland', 'name_ar' => 'أشووك ليلاند'],

            // 🚜 Agricultural & Special Equipment
            ['name_en' => 'New Holland', 'name_ar' => 'نيو هولاند'],
            ['name_en' => 'CLAAS', 'name_ar' => 'كلاس'],
            ['name_en' => 'Massey Ferguson', 'name_ar' => 'ماسي فيرغسون'],
            ['name_en' => 'Same Deutz-Fahr', 'name_ar' => 'سام دويتز'],
            ['name_en' => 'Valtra', 'name_ar' => 'فالترا'],

            // ⚙️ Generators & Industrial
            ['name_en' => 'Cummins', 'name_ar' => 'كمنز'],
            ['name_en' => 'Perkins', 'name_ar' => 'بيركنز'],
            ['name_en' => 'MTU', 'name_ar' => 'إم تي يو'],
            ['name_en' => 'FG Wilson', 'name_ar' => 'إف جي ويلسون'],
        ];

        foreach ($brands as $brand) {
            EquipmentBrand::updateOrCreate(
                ['name_en' => $brand['name_en']],
                [
                    'name_ar' => $brand['name_ar'],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]
            );
        }
    }
}
