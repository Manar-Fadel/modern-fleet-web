<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('heavy_vehicle_images', function (Blueprint $table) {
            $table->id();

            $table->foreignId('heavy_vehicle_id')
                ->constrained('heavy_vehicles')
                ->cascadeOnDelete();

            $table->string('path'); // storage path: heavy_vehicles/xxx.jpg
            $table->boolean('is_main')->default(false);
            $table->unsignedInteger('sort_order')->default(0);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('heavy_vehicle_images');
    }
};
