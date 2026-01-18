<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'full_name',
        'email',
        'password',
        'company_id',
        'email_verified',
        'type',
        'email_verified_at',
        'phone_number'
    ];

    protected $hidden = ['password'];

    public function company(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Company::class, );
    }
    public function carRequests(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CarRequest::class);
    }
    public function logs(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(SystemLog::class);
    }
    public function country(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
    public function city(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}
