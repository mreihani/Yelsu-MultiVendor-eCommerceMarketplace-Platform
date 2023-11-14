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
        Schema::table('shetabit_visits', function (Blueprint $table) {
            $table->text('country_name')->nullable();
            $table->text('country_code')->nullable();
            $table->text('province_name')->nullable();
            $table->text('city_name')->nullable();
            $table->text('latitude')->nullable();
            $table->text('longitude')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('shetabit_visits', function (Blueprint $table) {
            $table->dropColumn([
                'country_name', 
                'country_code', 
                'province_name', 
                'city_name', 
                'latitude',
                'longitude'
            ]);
        });
    }
};
