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
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('type')->nullable();
            $table->string('category_id')->nullable();
            $table->string('vendor_id')->nullable();
            $table->text('category_id_temp')->nullable();
            $table->text('vendor_id_temp')->nullable();
            $table->text('type_temp')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->text('freightage_loader_type')->nullable();
            $table->text('freightage_loader_type_temp')->nullable();
            $table->string('verification_id_card')->nullable();
            $table->string('verification_applicant_image')->nullable();
            $table->string('verification_company_activity_license')->nullable();
            $table->string('verification_company_establishment_announcement')->nullable();
            $table->enum('verification_status', ['active', 'inactive'])->default('inactive');
            $table->string('verification_company_value_added_certificate')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down() : void
    {
        Schema::dropIfExists('drivers');
    }
};