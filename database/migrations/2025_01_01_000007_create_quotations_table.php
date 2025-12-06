<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('quotations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('request_id')->constrained('heavy_vehicle_requests')->cascadeOnDelete();
            $table->decimal('price_total', 15, 2);
            $table->text('description')->nullable();
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
            $table->softDeletes();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('quotations');
    }
};