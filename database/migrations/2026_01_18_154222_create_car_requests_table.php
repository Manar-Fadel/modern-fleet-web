<?php

use App\Managers\Constants;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('car_requests', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique()->index();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->enum('type', ['car', 'heavy_vehicle'])->default('car');

            $table->enum('status', [
                Constants::PENDING,
                Constants::ACCEPTED,
                Constants::REJECTED,
                Constants::PAID,
                Constants::IN_DELIVERY,
                Constants::DONE
            ])->default(Constants::PENDING);

            $table->text('notes')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('car_requests');
    }
};
