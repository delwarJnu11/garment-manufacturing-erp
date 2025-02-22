<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'sku',
        'description',
        'unit_price',
        'offer_price',
        'weight',
        'size_id',
        'is_raw_material',
        'barcode',
        'rfid',
        'category_id',
        'uom_id',
        'valuation_method_id',
        'photo'
    ];
    
}
