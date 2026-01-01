<?php

namespace App\Managers;

use App\Models\Car;
use App\Models\CarCategory;
use App\Models\HeavyVehicle;

class CarManager
{
    public static function getCategoriesList(): \Illuminate\Database\Eloquent\Collection
    {
        return CarCategory::query()->orderBy('id', 'ASC')->get();
    }
    public static function getMain()
    {
        return  Car::main()
            ->orderBy('id', 'DESC')
            ->has('brand')
            ->has('brandModel')
            ->take(6)
            ->get();
    }
}
