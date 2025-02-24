<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductLot extends Model
{
    use HasFactory;

    // Add raw_material_id to the fillable array
    protected $fillable = [
        'raw_material_id',
        'quantity',
        'cost_price',
        'warehouse_id',
        'description',
    ];
}
