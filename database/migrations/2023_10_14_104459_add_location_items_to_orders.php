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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('order_shipping_location_name')->nullable();
            $table->string('order_shipping_country')->nullable();
            $table->string('order_shipping_province')->nullable();
            $table->string('order_shipping_city')->nullable();
            $table->string('order_shipping_address')->nullable();
            $table->string('order_shipping_postalcode')->nullable();
            $table->string('order_shipping_phone')->nullable();
            $table->string('order_shipping_fax')->nullable();
            $table->string('order_shipping_latitude')->nullable();
            $table->string('order_shipping_longitude')->nullable();
            $table->string('order_shipping_z_coords')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'order_shipping_location_name',
                'order_shipping_country',
                'order_shipping_province',
                'order_shipping_city',
                'order_shipping_address',
                'order_shipping_postalcode',
                'order_shipping_phone',
                'order_shipping_fax',
                'order_shipping_latitude',
                'order_shipping_longitude',
                'order_shipping_z_coords'
            ]);
        });
    }
};
