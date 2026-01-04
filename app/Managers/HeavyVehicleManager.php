<?php

namespace App\Managers;

use App\Models\HeavyVehicle;
use App\Models\HeavyVehicleCategory;

class HeavyVehicleManager
{
    public static function getMain()
    {
        return HeavyVehicle::main()
            ->orderBy('id', 'DESC')
            ->has('brand')
            ->has('brandModel')
            ->take(3)
            ->get();
    }
    public static function getCategoriesList(): \Illuminate\Database\Eloquent\Collection
    {
        return HeavyVehicleCategory::query()->orderBy('id', 'ASC')->get();
    }
    public static function getCategoriesWithMainVehicles(): \Illuminate\Database\Eloquent\Collection
    {
        return HeavyVehicleCategory::query()
            ->withCount(['heavyVehicles as vehicles_count' => function ($q) {
                $q->where('is_main', true);
            }])
            ->with(['heavyVehicles' => function ($q) {
                $q->where('is_main', true)
                    ->latest()
                    ->limit(4);
            }])
            ->orderByDesc('vehicles_count')
            ->limit(5)
            ->get();
    }
}
