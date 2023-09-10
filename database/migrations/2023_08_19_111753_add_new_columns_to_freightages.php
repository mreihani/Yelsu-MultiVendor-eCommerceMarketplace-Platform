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
        Schema::table('freightages', function (Blueprint $table) {
            $table->text('category_id_temp')->nullable();
            $table->text('vendor_id_temp')->nullable();
            $table->text('type_temp')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down() : void
    {
        Schema::table('freightages', function (Blueprint $table) {
            $table->dropColumn(['category_id_temp', 'vendor_id_temp', 'type_temp', 'status']);
        });
    }
};