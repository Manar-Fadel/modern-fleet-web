<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('car_request_quotation_images', function (Blueprint $table) {
            $table->id();

            $table->foreignId('car_request_quotation_id')
                ->constrained('car_request_quotations')
                ->cascadeOnDelete();

            $table->string('path');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_quotation_images');
    }
};
