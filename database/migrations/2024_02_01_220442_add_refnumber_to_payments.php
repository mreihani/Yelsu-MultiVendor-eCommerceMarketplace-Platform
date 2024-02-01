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
            $table->string('refnumber')->nullable();
            $table->string('rnn')->nullable();
            $table->string('maskedpan')->nullable();
            $table->string('terminal_number')->nullable();
            $table->string('original_amount')->nullable();
            $table->string('strace_date')->nullable();
            $table->string('strace_no')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn([
                'refnumber', 
                'rnn', 
                'maskedpan', 
                'terminal_number', 
                'original_amount', 
                'strace_date', 
                'strace_no', 
            ]);
        });
    }
};
