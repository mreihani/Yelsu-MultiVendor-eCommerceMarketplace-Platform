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
            $table->string('verification_company_value_added_certificate')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down() : void
    {
        Schema::table('freightages', function (Blueprint $table) {
            $table->dropColumn(['verification_company_value_added_certificate']);
        });
    }
};