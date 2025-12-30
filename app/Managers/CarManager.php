<?php

namespace App\Managers;

use App\Models\Car;
use App\Models\HeavyVehicle;

class CarManager
{
    public static function getMain()
    {
        return  Car::main()
            ->orderBy('id', 'DESC')
            ->has('brand')
            ->has('brandModel')
            ->take(10)
            ->get();
    }
}
