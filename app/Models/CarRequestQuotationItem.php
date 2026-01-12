<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CarRequestQuotationItem extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'car_request_quotation_id',
        'car_request_item_id',
        'unit_price',
        'attachment_price',
        'total_price',
        'vat_amount',
        'total_with_vat',
        'is_with_vat',
        'description',
    ];
    public function quotation(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(CarRequestQuotation::class);
    }
    public function requestItem(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(CarRequestItem::class, 'car_request_item_id');
    }
}
