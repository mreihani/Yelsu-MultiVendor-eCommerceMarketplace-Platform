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
        Schema::table('users', function (Blueprint $table) {
            $table->string('shaba_number')->nullable();
            $table->string('cart_number')->nullable();
            $table->string('cart_owner_info')->nullable();
            $table->string('cart_bank_info')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['shaba_number', 'cart_number', 'cart_owner_info', 'cart_bank_info']);
        });
    }
};
