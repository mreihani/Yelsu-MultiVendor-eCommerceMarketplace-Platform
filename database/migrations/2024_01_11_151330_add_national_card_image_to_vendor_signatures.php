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
        Schema::table('vendor_signatures', function (Blueprint $table) {
            $table->string('verification_company_national_card_image_all')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vendor_signatures', function (Blueprint $table) {
            $table->dropColumn([
                'verification_company_national_card_image_all', 
            ]);
        });
    }
};
