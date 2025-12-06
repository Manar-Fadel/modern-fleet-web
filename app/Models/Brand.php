<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name_en', 'name_ar'];

    public function models(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(BrandModel::class);
    }

    public function heavyVehicles(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(HeavyVehicle::class);
    }
}
