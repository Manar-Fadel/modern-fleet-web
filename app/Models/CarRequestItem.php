<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class CarRequestItem extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'car_request_id',
        'brand_id',
        'model_id',
        'manufacturing_year_id',
        'quantity',
        'description',
    ];
    public function request(): BelongsTo
    {
        return $this->belongsTo(CarRequest::class, 'car_request_id');
    }
    public function brand(): BelongsTo
    {
        return $this->belongsTo(EquipmentBrand::class, 'brand_id');
    }
    public function model(): BelongsTo
    {
        return $this->belongsTo(EquipmentModel::class, 'model_id');
    }
    public function year(): BelongsTo
    {
        return $this->belongsTo(ManufacturingYear::class, 'manufacturing_year_id');
    }
    public function images(): HasMany
    {
        return $this->hasMany(CarRequestItemImage::class);
    }
}
