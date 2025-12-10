<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model
{
    use SoftDeletes;

    protected $table = 'cars';

    protected $fillable = [
        'brand_id',
        'model_id',
        'manufacturing_year_id',
        'category_id',

        'condition',
        'fuel_type',
        'transmission',
        'drive_type',

        'engine_capacity',
        'engine_power',
        'mileage',
        'doors',
        'seats',

        'color',
        'origin',
        'location',

        'price',
        'is_with_vat',

        'description',
    ];

    protected $casts = [
        'is_with_vat' => 'boolean',
    ];

    /* ======================
        Relationships
    ====================== */
    public function brand(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(EquipmentBrand::class, 'brand_id');
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
        return $this->belongsTo(CarCategory::class);
    }
    public function images(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CarImage::class);
    }
    public function mainImage(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(CarImage::class)
            ->where('is_main', true);
    }
}
