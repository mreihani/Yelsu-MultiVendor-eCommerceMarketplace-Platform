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
        Schema::create('representatives', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('vendor_id');
            $table->foreign('vendor_id')->references('id')->on('users')->onDelete('cascade');
            $table->enum('representative_type', ['agency', 'delegation'])->default('agency');
            $table->text('geolocation_permission_province')->nullable();
            $table->text('geolocation_permission_city')->nullable();
            $table->text('geolocation_permission_export_country')->nullable();
            $table->string('verification_id_card')->nullable();
            $table->string('verification_applicant_image')->nullable();
            $table->string('verification_company_activity_license')->nullable();
            $table->string('verification_company_establishment_announcement')->nullable();
            $table->boolean('identity_verification_status')->default(false);
            $table->boolean('new_changes_verification_status')->default(false);
            $table->boolean('specific_geolocation_internal')->default(false);
            $table->boolean('specific_geolocation_external')->default(false);
            $table->timestamps();
        });

        Schema::create('product_representative', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->unsignedBigInteger('representative_id');
            $table->foreign('representative_id')->references('id')->on('representatives')->onDelete('cascade');
            $table->unsignedBigInteger('product_in_stock')->nullable();
            $table->boolean('change_price_permission')->default(false);
            $table->text('product_geolocation_permission_province')->nullable();
            $table->text('product_geolocation_permission_city')->nullable();
            $table->text('product_geolocation_permission_export_country')->nullable();
            $table->boolean('product_specific_geolocation_internal')->default(false);
            $table->boolean('product_specific_geolocation_external')->default(false);
            $table->primary(['product_id','representative_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('representative_product');
        Schema::dropIfExists('representatives');
    }
};
