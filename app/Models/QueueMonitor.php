<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QueueMonitor extends Model
{
    protected $fillable = [
        'job_class',
        'queue',
        'status',
        'attempts',
        'related_type',
        'related_id',
        'user_id',
        'payload',
        'error',
        'started_at',
        'finished_at',
    ];

    protected $casts = [
        'started_at'  => 'datetime',
        'finished_at' => 'datetime',
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
