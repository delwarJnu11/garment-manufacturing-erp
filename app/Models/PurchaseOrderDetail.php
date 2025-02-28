<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PurchaseOrderDetail extends Model
{
    // Define the fillable properties for mass assignment
    protected $fillable = [
        'purchase_id',
        'product_variant_id',
        'lot_id',
        'quantity',
        'price',
        'discount_price',
    ];
    function purchase(): BelongsTo
    {
        return $this->belongsTo(PurchaseOrder::class, 'purchase_id');
    }
}
