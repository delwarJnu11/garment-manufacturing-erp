<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PurchaseOrderDetail extends Model {
    // Define the fillable properties for mass assignment
    protected $fillable = [
        'purchase_id',
        'product_id',
        'lot_id',
        'quantity',
        '%_of_discount',
        'price',
        '%_of_vat',
        'vat',
        'discount',
    ];
    function purchase(): BelongsTo {
        return $this->belongsTo(PurchaseOrder::class, 'purchase_id');
    }
    // In PurchaseOrderDetail model
    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }
}