<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CarImage extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'car_id',
        'path',
        'is_main',
        'sort_order',
    ];
    public function car(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Car::class);
    }
    public function getPathAttribute(): string
    {
        return asset('storage/' . $this->path);
    }
}

