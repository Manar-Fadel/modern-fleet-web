<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Settings extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'code_key',
        'name_ar',
        'name_en',
        'value',
        'json_response',
    ];

}
