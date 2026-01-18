<?php

namespace Database\Seeders;

use App\Models\AttachmentType;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AttachmentTypesSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            ['name_ar' => 'كرين تلسكوبي', 'name_en' => 'Boom Crane'],
            ['name_ar' => 'كرين مفصلي', 'name_en' => 'Articulated Crane'],
            ['name_ar' => 'صندوق تبريد / تجميد', 'name_en' => 'Refrigerated / Freezer Box'],
            ['name_ar' => 'صهريج', 'name_en' => 'Tank'],
            ['name_ar' => 'صندوق مفتوح حديد', 'name_en' => 'Open Steel Box'],
            ['name_ar' => 'حافظة مغلقة جافة', 'name_en' => 'Dry Closed Box'],
            ['name_ar' => 'سلة كهرباء تلسكوبية', 'name_en' => 'Telescopic Aerial Work Platform (AWP)'],
            ['name_ar' => 'ضاغط نفايات', 'name_en' => 'Garbage Compactor'],
        ];

        foreach ($types as $type) {
            AttachmentType::updateOrCreate(
                ['name_en' => $type['name_en']],
                [
                    'name_ar' => $type['name_ar'],
                    'icon' => null,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]
            );
        }
    }
}
