<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrderDetail extends Model
{
    // Define the fillable properties for mass assignment
    protected $fillable = [
        'purchase_id',
        'lot_id',
        'quantity',
        'price',
        'discount_price',
    ];
}
