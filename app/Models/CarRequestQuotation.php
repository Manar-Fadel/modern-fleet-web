<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class CarRequestQuotation extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'car_request_id',
        'total_amount',
        'vat_amount',
        'total_with_vat',
        'status',
    ];

    public function request(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(CarRequest::class, 'car_request_id');
    }
    public function items(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CarRequestQuotationItem::class);
    }
    public function images(): HasMany
    {
        return $this->hasMany(CarRequestQuotationImage::class);
    }
}
