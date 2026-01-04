<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CarRequestImage extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'car_request_id',
        'path',
    ];
    public function carRequest(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Http\Requests\CarRequest::class, 'car_request_id');
    }
    public function getUrlAttribute(): string
    {
        return asset('storage/' . $this->path);
    }
}

