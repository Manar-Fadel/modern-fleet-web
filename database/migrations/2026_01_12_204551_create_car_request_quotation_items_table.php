<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('car_request_quotation_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('car_request_quotation_id')
                ->constrained('car_request_quotations')
                ->cascadeOnDelete();

            $table->foreignId('car_request_item_id')
                ->constrained('car_request_items')
                ->cascadeOnDelete();

            $table->decimal('unit_price', 12, 2);
            $table->decimal('attachment_price', 12, 2)->default(0);
            $table->decimal('total_price', 12, 2);

            $table->decimal('vat_amount', 12, 2)->default(0);
            $table->decimal('total_with_vat', 12, 2)->default(0);

            $table->boolean('is_with_vat')->default(false);

            $table->text('description')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('car_request_quotation_items');
    }
};
