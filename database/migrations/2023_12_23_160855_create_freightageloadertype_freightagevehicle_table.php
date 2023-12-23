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
        Schema::create('freightageloadertype_fvehicle', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('freightageloadertype_id');
            $table->foreign('freightageloadertype_id')->references('id')->on('freightageloadertypes')->onDelete('cascade');

            $table->unsignedBigInteger('fvehicle_id');
            $table->foreign('fvehicle_id')->references('id')->on('fvehicles')->onDelete('cascade');
            
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('freightageloadertype_fvehicle');
    }
};
