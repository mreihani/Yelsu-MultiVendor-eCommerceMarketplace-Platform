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
        Schema::create('freightage_vendor_invitations', function (Blueprint $table) {
            $table->id();
            $table->string('freightage_user_id')->nullable();
            $table->string('vendor_user_id')->nullable();
            $table->text('description')->nullable();
            $table->boolean('verified')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('freightage_vendor_invitations');
    }
};