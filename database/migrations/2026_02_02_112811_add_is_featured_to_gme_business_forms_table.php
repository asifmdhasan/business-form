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
            // $table->enum('is_featured', ['0','1'])->default('0')->after('status')->comment('0 = No, 1 = Yes');
            $table->boolean('is_featured')->default(false)->after('status')->comment('0 = No, 1 = Yes');
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
