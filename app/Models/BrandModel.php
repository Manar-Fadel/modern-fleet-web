<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BrandModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['brand_id', 'name_en', 'name_ar'];

    public function brand(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function heavyVehicles(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(HeavyVehicle::class, 'model_id');
    }
}
