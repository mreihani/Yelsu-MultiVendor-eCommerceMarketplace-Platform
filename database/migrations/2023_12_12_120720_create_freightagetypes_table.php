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
            $table->integer('parent');
            $table->string('value')->nullable();
            $table->string('description')->nullable();
            $table->enum('freightagetype_title', ['road', 'rail', 'sea', 'air', 'post'])->default('road');

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
        
        Schema::create('freightageloadertypes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('freightagetype_id');
            $table->foreign('freightagetype_id')->references('id')->on('freightagetypes')->onDelete('cascade');
            $table->integer('parent');
            $table->string('value')->nullable();
            $table->string('description')->nullable();
            $table->string('min_capacity')->nullable();
            $table->string('max_capacity')->nullable();
            $table->string('length')->nullable();
            $table->string('width')->nullable();
            $table->string('height')->nullable();
            $table->string('min_volume')->nullable();
            $table->string('max_volume')->nullable();
            $table->string('freight_per_ton_intracity')->nullable();
            $table->string('freight_per_ton_intercity')->nullable();
            $table->string('blog_link')->nullable();
            
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

        Schema::create('freightagevehicles', function (Blueprint $table) {
            $table->id();
            
            $table->string('value')->nullable();
            $table->string('description')->nullable();
            
            $table->unsignedBigInteger('freightageloadertype_id');
            $table->foreign('freightageloadertype_id')->references('id')->on('freightageloadertypes')->onDelete('cascade');
            
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('freightagevehicles');
        Schema::dropIfExists('freightageloadertype_product');
        Schema::dropIfExists('freightageloadertypes');
        Schema::dropIfExists('freightagetypes');
    }
};
