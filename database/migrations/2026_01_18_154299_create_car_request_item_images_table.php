<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('car_request_item_images', function (Blueprint $table) {
            $table->id();

            $table->foreignId('car_request_item_id')
                ->constrained('car_request_items')
                ->cascadeOnDelete();

            $table->string('path');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('car_request_item_images');
    }
};
