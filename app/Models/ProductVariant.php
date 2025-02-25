<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    // Define the fillable columns for mass assignment
    protected $fillable = [
        'name',
        'product_type_id',
        'size_id',
        'sku',
        'unit_price',
    ];
}
