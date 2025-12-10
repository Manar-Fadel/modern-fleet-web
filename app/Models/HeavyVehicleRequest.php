<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HeavyVehicleRequest extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id', 'brand_id', 'model_id', 'quantity', 'description',
        'fuel_type', 'condition', 'manufacturing_year_id',
        'order_number', 'status', 'accepted_quotations_id', 'accepted_user_id',
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
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

    public function quotations(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(HeavyVehicleQuotation::class, 'request_id');
    }
    public function country(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
    public function city(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}
