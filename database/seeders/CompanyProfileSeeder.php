<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanyProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
}
