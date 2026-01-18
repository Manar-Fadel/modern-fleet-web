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
        Schema::table('car_requests', function (Blueprint $table) {
            $table->unsignedBigInteger('accepted_quotation_id')->nullable()->after('notes');
            $table->unsignedBigInteger('accepted_user_id')->nullable()->after('accepted_quotation_id');

            $table->foreign('accepted_quotation_id')
                ->references('id')
                ->on('car_quotations')
                ->nullOnDelete();

            $table->foreign('accepted_user_id')
                ->references('id')
                ->on('users')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('car_requests', function (Blueprint $table) {
            //
        });
    }
};
