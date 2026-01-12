<?php

use App\Managers\Constants;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('car_request_quotations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('car_request_id')
                ->constrained('car_requests')
                ->cascadeOnDelete();

            $table->decimal('total_amount', 12, 2)->default(0);
            $table->decimal('vat_amount', 12, 2)->default(0);
            $table->decimal('total_with_vat', 12, 2)->default(0);
            $table->string('type')->default('car')->nullable();

            $table->enum('status', [
                Constants::PENDING,
                Constants::ACCEPTED,
                Constants::REJECTED,
                Constants::PAID,
                Constants::IN_DELIVERY,
                Constants::DONE
            ])->default(Constants::PENDING);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('car_request_quotations');
    }
};
