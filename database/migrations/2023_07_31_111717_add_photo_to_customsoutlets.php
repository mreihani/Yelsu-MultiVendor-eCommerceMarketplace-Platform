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
        Schema::table('customsoutlets', function (Blueprint $table) {
            $table->string('photo')->nullable();
            $table->text('about_customs')->nullable();
            $table->text('customs_specs')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down() : void
    {
        Schema::table('customsoutlets', function (Blueprint $table) {
            $table->dropColumn(['photo', 'about_customs', 'customs_specs']);
        });
    }
};