<?php

namespace App\Traits;

use App\Models\QueueMonitor;

trait QueueMonitorable
{
    protected QueueMonitor $monitor;

    protected function startMonitoring(
        ?string $relatedType = null,
        ?int $relatedId = null
    ): void
    {
        $this->monitor = QueueMonitor::create([
            'job_class'   => static::class,
            'queue'       => $this->queue ?? 'default',
            'status'      => 'pending',
            'attempts'    => $this->attempts(),
            'related_type'=> $relatedType,
            'related_id'  => $relatedId,
            'user_id'     => auth()->id(),
            'payload'     => json_encode($this),
        ]);
    }

    protected function markRunning(): void
    {
        $this->monitor->update([
            'status' => 'running',
            'started_at' => now(),
        ]);
    }

    protected function markCompleted(): void
    {
        $this->monitor->update([
            'status' => 'completed',
            'finished_at' => now(),
        ]);
    }

    protected function markFailed(\Throwable $exception): void
    {
        $this->monitor->update([
            'status' => 'failed',
            'error' => $exception->getMessage(),
        ]);
    }
}
