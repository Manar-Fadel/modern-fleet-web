<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CarQuotationImage extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'quotation_id',
        'path',
    ];
    public function carQuotation(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(CarRequestItem::class, 'quotation_id');
    }
    public function getUrlAttribute(): string
    {
        return asset('storage/' . $this->attributes['path']);
    }
}

