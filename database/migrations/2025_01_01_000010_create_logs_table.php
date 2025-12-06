<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->string('action');
            $table->text('details')->nullable();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->ipAddress('ip')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('logs');
    }
};