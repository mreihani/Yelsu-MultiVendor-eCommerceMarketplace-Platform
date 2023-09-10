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
        Schema::create('customsoutlets', function (Blueprint $table) {
            $table->id();
            $table->enum('customs_type', ['customs', 'port', 'free_zone', 'special_zone'])->default('customs');
            $table->string('name')->nullable();
            $table->string('country')->nullable();
            $table->string('province')->nullable();
            $table->string('address')->nullable();
            $table->string('postalcode')->nullable();
            $table->string('phone')->nullable();
            $table->string('fax')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('z')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down() : void
    {
        Schema::dropIfExists('customsoutlets');
    }
};