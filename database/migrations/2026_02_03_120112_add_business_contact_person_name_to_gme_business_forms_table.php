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
            $table->string('business_contact_person_name')
                  ->nullable()
                  ->after('business_name');
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
