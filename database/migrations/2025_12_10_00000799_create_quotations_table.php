<?php

use App\Managers\Constants;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('heavy_vehicle_quotations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('request_id')->constrained('heavy_vehicle_requests');
            $table->foreignId('user_id')->constrained('users');
            $table->decimal('total_price', 15, 2);
            $table->decimal('unit_price', 15, 2);
            $table->text('description')->nullable();
            $table->tinyInteger('is_with_vat')->nullable()->default(0);
            $table->enum('status', [Constants::PENDING, Constants::ACCEPTED, Constants::REJECTED, Constants::PAID, Constants::IN_DELIVERY])->default('pending');
            $table->softDeletes();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('quotations');
    }
};
