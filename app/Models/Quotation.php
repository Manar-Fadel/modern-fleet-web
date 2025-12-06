<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quotation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['request_id', 'price_total', 'description', 'status'];

    public function request(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(HeavyVehicleRequest::class, 'request_id');
    }

    public function purchaseOrder(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(PurchaseOrder::class, 'quotation_id');
    }
}
