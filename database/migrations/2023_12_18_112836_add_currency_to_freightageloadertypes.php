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
        Schema::table('freightageloadertypes', function (Blueprint $table) {
            $table->boolean('last_child')->default(false);
            $table->enum('freight_per_ton_currency', ['toman', 'dollar', 'euro'])->default('toman');
            $table->string('freight_per_ton_rail')->nullable();
            $table->string('freight_per_ton_sea')->nullable();
            $table->string('freight_per_kg_air')->nullable();
            $table->string('freight_per_kg_post')->nullable();
            $table->string('clearance_per_ton_rail')->nullable();
            $table->string('clearance_per_ton_sea')->nullable();
            $table->string('clearance_per_kg_air')->nullable();
            $table->string('clearance_per_kg_post')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('freightageloadertypes', function (Blueprint $table) {
            $table->dropColumn([
                'last_child', 
                'freight_per_ton_currency',
                'freight_per_ton_rail',
                'freight_per_ton_sea',
                'freight_per_kg_air',
                'freight_per_kg_post',
                'clearance_per_ton_rail',
                'clearance_per_ton_sea',
                'clearance_per_kg_air',
                'clearance_per_kg_post',
            ]);
        });
    }
};
