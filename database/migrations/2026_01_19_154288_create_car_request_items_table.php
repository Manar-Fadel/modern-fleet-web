<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('car_request_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('car_request_id')
                ->constrained('car_requests')
                ->cascadeOnDelete();

            $table->foreignId('brand_id')
                ->constrained('brands')
                ->cascadeOnDelete();

            $table->foreignId('model_id')
                ->constrained('brand_models')
                ->cascadeOnDelete();

            $table->foreignId('manufacturing_year_id')
                ->nullable()
                ->constrained('manufacturing_years')
                ->nullOnDelete();

            $table->unsignedInteger('quantity')->default(1);

            $table->text('description')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('car_request_items');
    }
};
