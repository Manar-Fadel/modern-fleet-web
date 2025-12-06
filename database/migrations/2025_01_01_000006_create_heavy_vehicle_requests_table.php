<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('heavy_vehicle_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('brand_id')->nullable('brands')->constrained();
            $table->foreignId('model_id')->nullable()->constrained('brand_models');
            $table->foreignId('manufacturing_year_id')->nullable()->constrained('manufacturing_years');
            $table->integer('quantity');
            $table->string('city');
            $table->text('description')->nullable();
            $table->string('fuel_type')->nullable();
            $table->string('condition')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('heavy_vehicle_requests');
    }
};
