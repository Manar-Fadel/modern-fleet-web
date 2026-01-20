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
        Schema::table('car_request_items', function (Blueprint $table) {

            $table->boolean('is_attachments_enabled')
                ->default(false)
                ->after('quantity');

            $table->integer('attachment_type_id')
                ->nullable()
                ->after('is_attachments_enabled');

            $table->text('attachment_description')
                ->nullable()
                ->after('attachment_type_id');

        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('car_request_items', function (Blueprint $table) {
            //
        });
    }
};
