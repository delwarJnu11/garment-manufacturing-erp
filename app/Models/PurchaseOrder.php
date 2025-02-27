<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PurchaseOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_id', // Add this field
        'lot_id',
        'status_id',
        'order_total',
        'paid_amount',
        'discount',
        'vat',
        'delivery_date'
    ];

    public function inv_supplier(): BelongsTo
    {
        return $this->belongsTo(inv_suppliers::class, 'supplier_id');
    }

    public function product_lot(): BelongsTo
    {
        return $this->belongsTo(ProductLot::class, 'lot_id');
    }
    public function purchase_status(): BelongsTo
    {
        return $this->belongsTo(Purchase_status::class, 'status_id');
    }
}
