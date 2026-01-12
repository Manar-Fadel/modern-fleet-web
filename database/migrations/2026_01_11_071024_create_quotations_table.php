<?php

use App\Managers\Constants;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('car_quotations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_request_id')->constrained('car_requests');
            $table->foreignId('user_id')->constrained('users');

            $table->decimal('unit_price', 15, 2);
            $table->decimal('attachment_price', 15, 2);
            $table->decimal('total_price', 15, 2);
            $table->decimal('vat_amount', 15, 2);
            $table->decimal('total_with_vat', 15, 2);


            $table->text('description')->nullable();
            $table->tinyInteger('is_with_vat')->nullable()->default(0);
            $table->enum('status', [
                Constants::PENDING,
                Constants::ACCEPTED,
                Constants::REJECTED,
                Constants::PAID,
                Constants::IN_DELIVERY,
                Constants::DONE
            ])->default('pending');
            $table->softDeletes();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('heavy_vehicle_quotations');
    }
};
