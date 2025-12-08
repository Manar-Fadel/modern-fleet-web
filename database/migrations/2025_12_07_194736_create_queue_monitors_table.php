<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('queue_monitors', function (Blueprint $table) {
            $table->id();

            $table->string('job_class');
            $table->string('queue')->default('default');

            $table->enum('status', [
                'pending',
                'running',
                'completed',
                'failed'
            ])->default('pending');

            $table->unsignedInteger('attempts')->default(0);

            $table->string('related_type')->nullable(); // RFQ, Offer, etc
            $table->unsignedBigInteger('related_id')->nullable();

            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();

            $table->longText('payload')->nullable();
            $table->longText('error')->nullable();

            $table->timestamp('started_at')->nullable();
            $table->timestamp('finished_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('queue_monitors');
    }
};
