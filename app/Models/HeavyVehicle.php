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
        'location', 'fuel_type', 'engine_power', 'weight', 'capacity', 'transmission',
        'mileage', 'origin', 'description'
    ];

    public function brand(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function brandModel(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(BrandModel::class, 'model_id');
    }

    public function year(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ManufacturingYear::class, 'manufacturing_year_id');
    }

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(HeavyVehicleCategory::class, 'category_id');
    }
}
