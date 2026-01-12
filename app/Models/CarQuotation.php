<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class CarQuotation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['car_request_id', 'user_id',
        'type', 'total_price', 'unit_price',
        'attachment_price', 'vat_amount', 'total_with_vat',
        'is_with_vat', 'description', 'status'];

    protected $casts = [
        'is_with_vat' => 'boolean',
    ];
    public function request(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(CarRequest::class, 'car_request_id');
    }
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function purchaseOrder(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(PurchaseOrder::class, 'quotation_id');
    }
    public function images(): HasMany
    {
        return $this->hasMany(CarQuotationImage::class);
    }
}
