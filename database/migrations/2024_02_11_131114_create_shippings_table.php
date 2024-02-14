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
        Schema::create('shippings', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('order_vproduct_id');
            $table->foreign('order_vproduct_id')->references('id')->on('order_vproducts')->onDelete('cascade');

            $table->string('selected_row_id')->nullable();

            $table->string('selected_order_origin_address_id')->nullable();
            $table->text('order_origin_address')->nullable();

            $table->string('selected_order_destination_address_id')->nullable();
            $table->text('order_destination_address')->nullable();

            $table->string('selected_freightage_information_id')->nullable();
            $table->text('freightage_information')->nullable();

            $table->string('selected_freightage_activity_field_id')->nullable();
            $table->text('freightage_activity_field')->nullable();

            $table->string('selected_freightage_loadertype_id')->nullable();
            $table->text('freightage_loadertype')->nullable();

            $table->string('deliver_date_input')->nullable();
            $table->string('number_of_request_input')->nullable();
            $table->string('distance_by_kilometer')->nullable();
            $table->string('shipping_price')->nullable();
            $table->string('shipping_price_currency')->nullable();
            $table->string('neshan_arc_image_src')->nullable();
            $table->enum('shipping_status',['processing','completed'])->default('processing');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shippings');
    }
};
