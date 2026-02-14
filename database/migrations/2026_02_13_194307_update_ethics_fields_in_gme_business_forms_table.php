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
        Schema::table('gme_business_forms', function (Blueprint $table) {
            $table->dropColumn([
                'avoid_riba',
                'avoid_haram_products',
                'fair_pricing',
                'open_for_guidance'
            ]);
            // Add new column
            $table->json('finance_practices')->nullable();
            $table->json('product_practices')->nullable();
            $table->json('community_practices')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gme_business_forms', function (Blueprint $table) {
            //
        });
    }
};
