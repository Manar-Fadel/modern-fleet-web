<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ManufacturingYear extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['year'];

    public function heavyVehicles(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(HeavyVehicle::class, 'manufacturing_year_id');
    }

    public function heavyVehicleRequests(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(HeavyVehicleRequest::class, 'manufacturing_year_id');
    }
}
