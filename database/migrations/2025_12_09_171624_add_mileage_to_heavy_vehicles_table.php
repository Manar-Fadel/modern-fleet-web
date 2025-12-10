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
        Schema::table('heavy_vehicles', function (Blueprint $table) {
            $table->decimal('mileage', 10, 2)->nullable()->default(NULL);
            $table->string('origin', 250)->nullable()->default(NULL);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('heavy_vehicles', function (Blueprint $table) {
            //
        });
    }
};
