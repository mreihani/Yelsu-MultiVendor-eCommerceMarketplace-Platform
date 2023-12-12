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
        Schema::create('freightagetypes', function (Blueprint $table) {
            $table->id();
            $table->string('parent')->nullable();
            $table->string('value')->nullable();
            $table->string('description')->nullable();
            
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
        
        Schema::create('freightageloadertypes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('freightagetype_id');
            $table->foreign('freightagetype_id')->references('id')->on('freightagetypes')->onDelete('cascade');
            $table->enum('freightagetype_title', ['road', 'rail', 'sea', 'air'])->default('road');
            $table->string('parent')->nullable();
            $table->string('value')->nullable();
            $table->string('description')->nullable();
            
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });

        Schema::create('freightagetype_product', function (Blueprint $table) {
            $table->unsignedBigInteger('freightagetype_id');
            $table->foreign('freightagetype_id')->references('id')->on('freightagetypes')->onDelete('cascade');

            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            
            $table->primary(['freightagetype_id','product_id']);

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });

        Schema::create('freightageloadertype_product', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

            $table->unsignedBigInteger('freightageloadertype_id');
            $table->foreign('freightageloadertype_id')->references('id')->on('freightageloadertypes')->onDelete('cascade');
            
            $table->primary(['freightageloadertype_id','product_id']);

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('freightageloadertype_product');
        Schema::dropIfExists('freightagetype_product');
        Schema::dropIfExists('freightageloadertypes');
        Schema::dropIfExists('freightagetypes');
    }
};
