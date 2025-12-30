<?php

namespace App\Managers;

use App\Models\HeavyVehicle;

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
}
