<?php

use App\Managers\Constants;
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
        Schema::table('heavy_vehicle_requests', function (Blueprint $table) {
            $table->string('order_number')->after('manufacturing_year_id')->unique()->index();
            $table->enum('status', [Constants::PENDING, Constants::ACCEPTED, Constants::REJECTED, Constants::PAID, Constants::IN_DELIVERY])->default(Constants::PENDING)->after('order_number');
            $table->foreignId('accepted_quotations_id')->after('status')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('accepted_user_id')->after('status')->nullable()->constrained()->nullOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('heavy_vehicle_requests', function (Blueprint $table) {
            $table->dropForeign(['accepted_quotations_id']);
            $table->dropForeign(['accepted_user_id']);
            $table->dropColumn(['order_number', 'status']);
        });
    }
};
