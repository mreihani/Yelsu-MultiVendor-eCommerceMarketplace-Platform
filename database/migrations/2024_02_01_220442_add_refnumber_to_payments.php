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
            $table->text('terminal_id')->nullable();
            $table->text('refnumber')->nullable();
            $table->text('trance_no')->nullable();
            $table->text('amount')->nullable();
            $table->text('rrn')->nullable();
            $table->text('secure_pan')->nullable();
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
