<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CarRequestQuotationImage extends Model
{
    use SoftDeletes;

    protected $table = 'car_request_quotation_images';
    protected $fillable = [
        'car_request_quotation_id',
        'path',
    ];
    public function carQuotation(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(CarRequestItem::class, 'car_request_quotation_id');
    }
    public function getUrlAttribute(): string
    {
        return asset('storage/' . $this->attributes['path']);
    }
}

