<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EquipmentBrand extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'brands';
    protected $fillable = ['name_en', 'name_ar', 'logo'];

    protected function getNameAttribute(): ?string
    {
        $locale = app()->getLocale();
        return  ($locale == 'en') ? $this->name_en : $this->name_ar;
    }
    public function models(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(EquipmentModel::class, 'brand_id');
    }

    public function heavyVehicles(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(HeavyVehicle::class);
    }
    public function orders(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(HeavyVehicleRequest::class, 'brand_id');
    }
}
