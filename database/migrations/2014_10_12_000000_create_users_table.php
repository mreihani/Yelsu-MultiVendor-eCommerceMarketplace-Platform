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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('username')->unique()->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('photo')->nullable();
            $table->string('store_banner')->nullable();
            $table->string('shop_name')->nullable();
            $table->string('shop_address')->nullable();

            $table->text('home_province')->nullable();
            $table->text('home_city')->nullable();
            $table->text('home_address')->nullable();
            $table->text('home_postalcode')->nullable();
            $table->string('home_phone')->nullable();

            $table->text('shipping_province')->nullable();
            $table->text('shipping_city')->nullable();
            $table->text('shipping_address')->nullable();
            $table->text('shipping_postalcode')->nullable();

            $table->enum('role', ['admin', 'vendor', 'user', 'editor', 'specialist', 'financial', 'merchant', 'clearing_agent', 'freightage', 'retailer', 'driver', 'representative'])->default('user');
            $table->integer('specialist_category_id')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');

            $table->enum('twoStepAuth', ['active', 'inactive'])->default('inactive');

            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down() : void
    {
        Schema::dropIfExists('users');
    }
};