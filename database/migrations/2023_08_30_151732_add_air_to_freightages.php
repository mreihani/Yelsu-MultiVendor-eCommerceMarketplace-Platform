<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up() : void
    {
        Schema::table('freightages', function (Blueprint $table) {
            $table->text('freightage_loader_type_rail')->nullable();
            $table->text('freightage_loader_type_rail_temp')->nullable();
            $table->text('freightage_loader_type_sea')->nullable();
            $table->text('freightage_loader_type_sea_temp')->nullable();
            $table->text('freightage_loader_type_air')->nullable();
            $table->text('freightage_loader_type_air_temp')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down() : void
    {
        Schema::table('freightages', function (Blueprint $table) {
            $table->dropColumn(['freightage_loader_type_rail', 'freightage_loader_type_rail_temp', 'freightage_loader_type_sea', 'freightage_loader_type_sea_temp', 'freightage_loader_type_air', 'freightage_loader_type_air_temp']);
        });
    }
};