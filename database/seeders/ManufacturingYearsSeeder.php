<?php

namespace Database\Seeders;

use App\Models\ManufacturingYear;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ManufacturingYearsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currentYear = Carbon::now()->year;

        for ($year = 1970; $year <= $currentYear; $year++) {
            ManufacturingYear::updateOrCreate(
                ['year' => $year],
                ['created_at' => now(), 'updated_at' => now()]
            );
        }
    }
}
