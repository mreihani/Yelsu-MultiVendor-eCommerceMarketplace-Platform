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
        Schema::create('productliveprices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->unsignedBigInteger('product_price_update_number')->nullable();
            $table->string('product_factory_name')->nullable();
            $table->string('product_latest_update')->nullable();
            $table->string('product_name')->nullable();
            $table->string('product_type')->nullable();
            $table->string('product_analyze')->nullable();
            $table->string('product_dimension')->nullable();
            $table->string('product_thickness')->nullable();
            $table->string('product_barbs_thickness')->nullable();
            $table->string('product_diameter')->nullable();
            $table->string('product_length')->nullable();
            $table->string('product_per_package')->nullable();
            $table->string('product_weight')->nullable();
            $table->string('product_unit_of_measurement')->nullable();
            $table->string('product_loading_place')->nullable();
            $table->string('product_size')->nullable();
            $table->string('product_price_yesterday')->nullable();
            $table->string('product_price_today')->nullable();

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productliveprices');
    }
};
