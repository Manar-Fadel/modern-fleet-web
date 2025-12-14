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
        Schema::create('car_requests', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique()->index();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('brand_id')->nullable('brands')->constrained()->nullOnDelete();
            $table->foreignId('model_id')->nullable()->constrained('brand_models')->nullOnDelete();
            $table->foreignId('manufacturing_year_id')->nullable()->constrained('manufacturing_years');
            $table->integer('quantity');
            $table->text('description')->nullable();
            $table->enum('status', [Constants::PENDING, Constants::ACCEPTED, Constants::REJECTED, Constants::PAID, Constants::IN_DELIVERY])->default(Constants::PENDING);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_requests');
    }
};
