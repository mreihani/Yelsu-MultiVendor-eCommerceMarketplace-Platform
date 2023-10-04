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
        Schema::create('attributes', function (Blueprint $table) {
            $table->id();
            $table->string('attribute_category_name');
            $table->string('role')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('attribute_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('attribute_id');
            $table->foreign('attribute_id')->references('id')->on('attributes')->onDelete('cascade');
            $table->string('attribute_item_name');
            $table->string('attribute_item_description')->nullable();
            $table->string('attribute_item_keyword')->nullable();
            $table->boolean('attribute_item_required')->default(false);
            $table->enum('attribute_item_type', ['input_field', 'dropdown'])->default('dropdown');
            $table->boolean('show_in_table_page')->default(false);
            $table->boolean('show_in_product_page')->default(false);
            $table->boolean('disabled_attribute')->default(false);
            $table->boolean('multiple_selection_attribute')->default(false);
            $table->text('attribute_list_array')->nullable();
            $table->timestamps();
        });

        Schema::create('attribute_values', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('attribute_item_id');
            $table->foreign('attribute_item_id')->references('id')->on('attribute_items')->onDelete('cascade');
            $table->string('value');
            $table->timestamps();
        });

        Schema::create('attribute_product', function (Blueprint $table) {
            $table->unsignedBigInteger('attribute_id');
            $table->foreign('attribute_id')->references('id')->on('attributes')->onDelete('cascade');
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->unsignedBigInteger('attribute_item_id');
            $table->foreign('attribute_item_id')->references('id')->on('attribute_items')->onDelete('cascade');
            $table->unsignedBigInteger('attribute_value_id');
            $table->foreign('attribute_value_id')->references('id')->on('attribute_values')->onDelete('cascade');
            $table->text('attribute_value')->nullable();
            $table->primary(['attribute_id', 'product_id', 'attribute_item_id', 'attribute_value_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attribute_product');
        Schema::dropIfExists('attribute_values');
        Schema::dropIfExists('attribute_items');
        Schema::dropIfExists('attributes');
    }
};
