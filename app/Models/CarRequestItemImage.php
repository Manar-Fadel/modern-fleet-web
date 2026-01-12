<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CarRequestItemImage extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'car_request_item_id',
        'path',
    ];
    public function item(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(CarRequestItem::class, 'car_request_item_id');
    }
    public function getUrlAttribute(): string
    {
        return asset('storage/' . $this->attributes['path']);
    }
}

