<?php

namespace App\Managers;

use App\Models\EquipmentBrand;
use App\Models\City;
use App\Models\ManufacturingYear;
use Illuminate\Support\Facades\Storage;

class AdminManager
{
    public static function getBrandsAsArray($type): \Illuminate\Database\Eloquent\Collection
    {
        if ($type === 'cars') {
            return EquipmentBrand::cars()->orderBy('id', 'ASC')->get();

        }elseif ($type === 'heavy_vehicles') {
            return EquipmentBrand::heavyVehicle()->orderBy('id', 'ASC')->get();

        }else{
            return EquipmentBrand::query()->orderBy('id', 'ASC')->get();
        }
    }
    public static function getYearsAsArray(): \Illuminate\Database\Eloquent\Collection
    {
        return ManufacturingYear::query()->orderBy('year', 'DESC')->get();
    }
    public static function getCitiesAsArray(): \Illuminate\Database\Eloquent\Collection
    {
        return City::query()->orderBy('id', 'ASC')->get();
    }
    public static function uploadImageFile($file, $folder_name): string
    {
        return $file->storeAs($folder_name, uniqid().'-'.time().'.'.$file->getClientOriginalExtension(), 'public');
    }
}
