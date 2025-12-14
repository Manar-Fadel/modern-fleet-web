<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EquipmentModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'brand_models';
    protected $fillable = ['brand_id', 'name_en', 'name_ar'];

    protected function getNameAttribute(): ?string
    {
        $locale = app()->getLocale();
        return  ($locale == 'en') ? $this->name_en : $this->name_ar;
    }
    public function brand(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(EquipmentBrand::class);
    }

    public function heavyVehicles(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(HeavyVehicle::class, 'model_id');
    }
    public function heavyVehicleRequests(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(HeavyVehicleRequest::class, 'model_id');
    }
}
