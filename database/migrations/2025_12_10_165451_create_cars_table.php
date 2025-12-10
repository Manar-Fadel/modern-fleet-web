<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();

            $table->foreignId('brand_id')
                ->constrained('brands')
                ->OnDelete('set null');

            $table->foreignId('model_id')
                ->constrained('brand_models')
                ->OnDelete('set null');

            $table->foreignId('manufacturing_year_id')
                ->nullable()
                ->constrained('manufacturing_years')
                ->nullOnDelete();

            $table->foreignId('category_id')
                ->nullable()
                ->constrained('car_categories')
                ->nullOnDelete();

            // خصائص عامة للسيارات
            $table->enum('condition', ['new', 'used', 'refurbished'])
                ->default('used');

            $table->string('fuel_type', 50)->nullable();      // petrol, diesel, hybrid, electric
            $table->string('transmission', 50)->nullable();  // automatic, manual
            $table->string('drive_type', 50)->nullable();    // FWD, RWD, AWD

            $table->integer('engine_capacity')->nullable();  // CC
            $table->integer('engine_power')->nullable();     // HP
            $table->integer('mileage')->nullable();          // KM
            $table->integer('doors')->nullable();
            $table->integer('seats')->nullable();

            $table->string('color', 50)->nullable();
            $table->string('origin', 100)->nullable();       // Japan, Germany, etc

            $table->string('location')->nullable();

            // الأسعار
            $table->decimal('price', 12, 2)->nullable();
            $table->boolean('is_with_vat')->default(false);

            $table->text('description')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
