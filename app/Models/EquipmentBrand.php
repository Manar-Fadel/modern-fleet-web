<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\URL;

class EquipmentBrand extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'brands';
    protected $fillable = ['name_en', 'name_ar', 'is_main', 'logo'];
    protected $appends = [
        'name',
    ];
    protected $casts = [
        'is_main' => 'boolean',
    ];
    public function scopeMain($query)
    {
        return $query->where('is_main', true);
    }
    public function scopeCars($query)
    {
        return $query->where('is_car', true);
    }
    public function scopeHeavyVehicle($query)
    {
        return $query->where('is_heavy_vehicle', true);
    }
    protected function getNameAttribute(): ?string
    {
        $locale = app()->getLocale();
        return  ($locale == 'en') ? $this->name_en : $this->name_ar;
    }
    public function models(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(EquipmentModel::class, 'brand_id');
    }

    public function getLogoAttribute($value): string
    {
        if ($value) {
            return URL::asset("storage/".$value);
        }
        return asset("storage/brand-vector.jpg");
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
