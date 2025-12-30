<?php

namespace App\Jobs;

use App\Models\User;
use App\Traits\QueueMonitorable;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SendVerifyEmailAddressEmailJob implements ShouldQueue
{
    use Queueable, QueueMonitorable;

    public User $user;
    /**
     * Create a new job instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->startMonitoring(
            relatedType: 'User',
            relatedId: $user->id
        );
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->markRunning();

        event(new Registered($this->user));

        $this->markCompleted();
    }
    public function failed(\Throwable $exception): void
    {
        $this->markFailed($exception);
    }
}
