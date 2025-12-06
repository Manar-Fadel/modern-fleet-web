<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('heavy_vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->constrained()->cascadeOnDelete();
            $table->foreignId('model_id')->constrained('brand_models')->cascadeOnDelete();
            $table->foreignId('manufacturing_year_id')->nullable()->constrained('manufacturing_years');
            $table->foreignId('category_id')->constrained('heavy_vehicle_categories');$table->string('location')->nullable();
            $table->enum('condition', ['new','used','refurbished'])->default('used');

            $table->integer('hours_used')->nullable();
            $table->integer('operating_weight')->nullable();
            $table->string('engine_power')->nullable();
            $table->string('bucket_capacity')->nullable();
            $table->string('lifting_capacity')->nullable();

            $table->string('fuel_type')->nullable();
            $table->string('transmission_type')->nullable();
            $table->string('cabin_type')->nullable();

            $table->string('axle_configuration')->nullable();
            $table->integer('payload_capacity')->nullable();
            $table->string('boom_length')->nullable();
            $table->string('drum_width')->nullable();
            $table->string('compaction_force')->nullable();

            $table->enum('availability_status', ['in_stock','coming_soon','reserved'])
                ->default('in_stock');

            $table->decimal('price', 12, 2)->nullable();
            $table->string('currency', 5)->default('USD');

            $table->text('description')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('heavy_vehicles');
    }
};
