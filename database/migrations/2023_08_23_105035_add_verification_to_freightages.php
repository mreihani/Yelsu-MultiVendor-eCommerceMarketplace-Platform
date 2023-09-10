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
            $table->string('verification_company_establishment_announcement')->nullable();
            $table->enum('verification_status', ['active', 'inactive'])->default('inactive');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down() : void
    {
        Schema::table('freightages', function (Blueprint $table) {
            $table->dropColumn(['verification_company_establishment_announcement', 'verification_status']);
        });
    }
};