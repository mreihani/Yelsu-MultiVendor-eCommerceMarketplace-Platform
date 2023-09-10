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
        Schema::table('products', function (Blueprint $table) {
            $table->enum('measurement',['none','number','ton','barrel','kg','gr','carat','sot','property','unit','piece','device','branch','roll','gallon','lit','m3'])->default('none');
            $table->enum('packing',['none','tanker','tank','container','jambobag','bulk','pocket','bandil','barrel','gallon'])->default('none');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['measurement', 'cart_packingnumber']);
        });
    }
};
