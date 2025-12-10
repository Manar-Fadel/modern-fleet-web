<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HeavyVehicleImage extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'heavy_vehicle_id',
        'path',
        'is_main',
        'sort_order',
    ];

    public function heavyVehicle(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(HeavyVehicle::class);
    }
    public function getUrlAttribute(): string
    {
        return asset('storage/' . $this->path);
    }
    public function scopeMain($query)
    {
        return $query->where('is_main', true);
    }
}
