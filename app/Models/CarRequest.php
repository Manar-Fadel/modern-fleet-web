<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class CarRequest extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'type',
        'status',
        'notes',
        'user_id',
        'order_number',
        'accepted_quotations_id',
        'accepted_user_id',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(CarRequestItem::class);
    }
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function quotations(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CarRequestQuotation::class, 'car_request_id');
    }
    public function country(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
    public function city(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(City::class);
    }
    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($order) {
            if (!$order->order_number) {
                $year = now()->format('Y');
                $month = now()->format('M');
                $day = now()->format('d');
                $prefix = "#{$year}{$month}{$day}-";

                $lastOrder = self::whereYear('created_at', now()->year)
                    ->whereMonth('created_at', now()->month)
                    ->withTrashed()
                    ->latest('id')
                    ->first();

                $nextNumber = $lastOrder
                    ? intval(substr($lastOrder->order_number, -4)) + 1
                    : 1;

                $order->order_number = $prefix . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
            }
        });
    }
}
