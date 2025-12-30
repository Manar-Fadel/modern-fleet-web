<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HeavyVehicle extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'brand_id', 'model_id', 'manufacturing_year_id', 'category_id', 'condition',
        'location', 'fuel_type', 'engine_power', 'operating_weight', 'bucket_capacity',
        'lifting_capacity', 'payload_capacity',
        'mileage', 'origin', 'description', 'transmission_type',
        'is_main'
    ];

    protected $casts = [
        'is_main' => 'boolean',
    ];
    public function scopeMain($query)
    {
        return $query->where('is_main', true);
    }
    public function brand(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(EquipmentBrand::class);
    }
    public function brandModel(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(EquipmentModel::class, 'model_id');
    }
    public function year(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ManufacturingYear::class, 'manufacturing_year_id');
    }
    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(HeavyVehicleCategory::class, 'category_id');
    }
    public function images(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(HeavyVehicleImage::class);
    }
    public function mainImage()
    {
        return $this->hasOne(HeavyVehicleImage::class)->main();
    }
}
