<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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

        // Insert data into the company_profiles table
        DB::table('company_profiles')->insert([
            'company_name' => 'DRHF Garments Ltd.',
            'established_year' => 2005,
            'company_type' => 'Garments Manufacturer & Exporter',
            'business_address' => '123 Factory Road, City, Country',
            'head_office' => '456 Head Office Avenue, City, Country',
            'contact_number' => '+88015510000000',
            'email' => 'info@abcgarments.com',
            'website' => 'https://www.drhfgarments.com',
            'factory_size' => '50000 sqft',
            'production_capacity' => '500,000 pcs/month',
            'number_of_employees' => 1500,
            'machinery_equipment' => 'Automated Sewing Machines, Cutting Machines, Packaging Units',
            'product_categories' => 'T-Shirts, Jeans, Jackets, Dresses',
            'export_markets' => 'USA, UK, Canada, Europe',
            'major_buyers' => 'Nike, Adidas, Zara',
            'certifications' => 'ISO 9001, WRAP, OEKO-TEX',
            'sustainability_initiatives' => 'Water Recycling, Solar Panels, Eco-friendly Fabrics',
            'compliance_standards' => 'Fair Labor Practices, Ethical Sourcing',
            'lead_time' => '30 Days',
            'shipping_logistics' => 'Air Freight, Sea Freight, DDP',
            'payment_terms' => 'LC, TT, Cash'
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_profiles'); // ✅ Correct table name
    }
};
