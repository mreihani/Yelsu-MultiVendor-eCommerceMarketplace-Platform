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
        Schema::create('product_loadertypes', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

            $table->unsignedBigInteger('freightageloadertype_id');
            $table->foreign('freightageloadertype_id')->references('id')->on('freightageloadertypes')->onDelete('cascade');

            $table->string('loader_type_min')->nullable();
            $table->string('loader_type_max')->nullable();
            $table->string('origin_loadertype_outlet')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_loadertypes');
    }
};
