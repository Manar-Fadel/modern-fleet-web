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
            $table->boolean('is_main')
                ->default(false)
                ->after('category_id');
        });
        Schema::table('cars', function (Blueprint $table) {
            $table->boolean('is_main')
                ->default(false)
                ->after('category_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('heavy_vehicles', function (Blueprint $table) {
            $table->dropColumn('is_main');
        });
        Schema::table('cars', function (Blueprint $table) {
            $table->dropColumn('is_main');
        });
    }
};
