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

        Schema::create('company_profiles', function (Blueprint $table) { // ✅ Use plural table name
            $table->id();
            $table->string('company_name');
            $table->integer('established_year')->nullable();
            $table->string('company_type')->nullable();
            $table->string('business_address')->nullable();
            $table->string('head_office')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->string('factory_size')->nullable();
            $table->string('production_capacity')->nullable();
            $table->integer('number_of_employees')->nullable();
            $table->text('machinery_equipment')->nullable();
            $table->text('product_categories')->nullable();
            $table->text('export_markets')->nullable();
            $table->text('major_buyers')->nullable();
            $table->text('certifications')->nullable();
            $table->text('sustainability_initiatives')->nullable();
            $table->text('compliance_standards')->nullable();
            $table->string('lead_time')->nullable();
            $table->text('shipping_logistics')->nullable();
            $table->string('payment_terms')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_profiles'); // ✅ Correct table name
    }
};
