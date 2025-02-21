<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyProfile extends Model
{
    use HasFactory;

    protected $table = 'company_profiles'; // Table name if not following Laravel's naming convention

    protected $fillable = [
        'company_name',
        'established_year',
        'company_type',
        'business_address',
        'head_office',
        'contact_number',
        'email',
        'website',
        'factory_size',
        'production_capacity',
        'number_of_employees',
        'machinery_equipment',
        'product_categories',
        'export_markets',
        'major_buyers',
        'certifications',
        'sustainability_initiatives',
        'compliance_standards',
        'lead_time',
        'shipping_logistics',
        'payment_terms',
    ];
}
