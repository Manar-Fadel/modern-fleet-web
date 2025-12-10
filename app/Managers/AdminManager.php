<?php

namespace App\Managers;

use App\Models\EquipmentBrand;
use App\Models\City;
use Illuminate\Support\Facades\Storage;

class AdminManager
{
    public static function getBrandsAsArray(): \Illuminate\Database\Eloquent\Collection
    {
        return EquipmentBrand::query()->orderBy('id', 'ASC')->get();
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
