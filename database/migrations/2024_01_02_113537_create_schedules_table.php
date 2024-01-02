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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->boolean('product_deliver_capacity')->default(false);
            $table->string('daily_deliver_capacity')->nullable();
            $table->string('daily_deliver_capacity_sold')->nullable();
            $table->string('today_date')->nullable();
            $table->timestamps();
        });

        Schema::create('schedule_dates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('schedule_id');
            $table->foreign('schedule_id')->references('id')->on('schedules')->onDelete('cascade');
            $table->string('specific_deliver_date')->nullable();
            $table->string('specific_deliver_date_format')->nullable();
            $table->string('specific_deliver_capacity')->nullable();
            $table->string('specific_deliver_capacity_sold')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedule_dates');
        Schema::dropIfExists('schedules');
    }
};
