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
        Schema::table('payments', function (Blueprint $table) {
            $table->string('terminal_id')->nullable();
            $table->string('refnumber')->nullable();
            $table->string('trance_no')->nullable();
            $table->string('amount')->nullable();
            $table->string('rrn')->nullable();
            $table->string('secure_pan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn([
                'terminal_id', 
                'refnumber', 
                'trance_no', 
                'amount', 
                'rrn', 
                'secure_pan', 
            ]);
        });
    }
};
