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
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('verification_company_value_added_certificate')->nullable();
            $table->string('verification_company_registration_number')->nullable();
            $table->string('verification_company_national_code')->nullable();
            $table->string('verification_company_economic_code')->nullable();
            $table->string('verification_company_value_added_registration_image')->nullable();
            $table->string('verification_company_national_card_image')->nullable();
            $table->string('verification_company_national_card_image_all')->nullable();
            $table->string('verification_company_official_gazette_image')->nullable();
            $table->string('verification_company_evat_address')->nullable();
            $table->string('verification_company_establishment_announcement')->nullable();
            $table->string('verification_company_operation_license')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->timestamps();
        });

        Schema::create('vendor_signatures', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vendor_id');
            $table->foreign('vendor_id')->references('id')->on('vendors')->onDelete('cascade');
            $table->string('vendor_signature_firstname')->nullable();
            $table->string('vendor_signature_lastname')->nullable();
            $table->string('vendor_signature_national_code')->nullable();
            $table->string('vendor_signature_phone')->nullable();
            $table->string('vendor_signature_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_signatures');
        Schema::dropIfExists('vendors');
    }
};
