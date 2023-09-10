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
            $table->text('freightage_loader_type')->nullable();
            $table->text('freightage_loader_type_temp')->nullable();
            $table->string('verification_id_card')->nullable();
            $table->string('verification_applicant_image')->nullable();
            $table->string('verification_company_activity_license')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down() : void
    {
        Schema::table('freightages', function (Blueprint $table) {
            $table->dropColumn(['freightage_loader_type', 'freightage_loader_type_temp', 'verification_id_card', 'verification_applicant_image', 'verification_company_activity_license']);
        });
    }
};