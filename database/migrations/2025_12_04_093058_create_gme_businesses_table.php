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
        Schema::create('gme_businesses', function (Blueprint $table) {
            $table->id();

            // Step 1: Business Identity
            $table->string('business_name');
            $table->string('tagline')->nullable();
            $table->string('year_established')->nullable();
            $table->string('business_category')->nullable();
            $table->string('business_countries')->nullable();
            $table->string('business_cities')->nullable();
            $table->text('business_address')->nullable();

            // Step 2: Founder & Contact (supports multi founder later)
            $table->string('founder_name');
            $table->string('founder_email');
            $table->string('founder_whatsapp')->nullable();
            $table->string('website')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('youtube')->nullable();
            $table->string('online_store')->nullable();

            // Contact Person
            $table->string('contact_person_name')->nullable();
            $table->string('contact_person_role')->nullable();
            $table->string('contact_person_email')->nullable();
            $table->string('contact_person_phone')->nullable();

            // Step 3: Business Size & Structure
            $table->string('registration_status')->nullable();
            $table->string('employee_count')->nullable();
            $table->string('operational_scale')->nullable();
            $table->string('annual_revenue')->nullable();
            $table->string('registration_document')->nullable();

            // Step 4: Business Description
            $table->text('business_overview')->nullable();
            $table->json('products')->nullable();
            $table->string('logo')->nullable();
            $table->json('photos')->nullable();

            // Step 5: Islamic Ethical Alignment
            $table->string('avoid_riba')->nullable();
            $table->string('avoid_haram_products')->nullable();
            $table->string('fair_pricing')->nullable();
            $table->text('ethical_description')->nullable();
            $table->string('open_for_guidance')->nullable();

            // Step 6: Collaboration
            $table->string('collaboration_open')->nullable();
            $table->json('collaboration_types')->nullable();

            // Step 7: Consent
            $table->boolean('info_accuracy')->default(true);
            $table->boolean('allow_publish')->default(true);
            $table->boolean('allow_contact')->default(true);
            $table->string('digital_signature')->nullable();

            // NEW COLUMN: STATUS
            $table->string('status')->default('pending'); // pending, approved, rejected

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gme_businesses');
    }
};
