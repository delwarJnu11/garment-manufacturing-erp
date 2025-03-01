<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PurchaseOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_id',
        'product_id',
        'product_lot_id', // Make sure this is included
        'status_id',
        'total_amount',
        'paid_amount',
        'discount',
        'vat',
        'delivery_date',
        'shipping_address',
        'description', // Nullable field
    ];

    public function inv_supplier(): BelongsTo
    {
        return $this->belongsTo(InvSupplier::class, 'supplier_id'); // Using the model name as is
    }


    public function product_lot(): BelongsTo
    {
        return $this->belongsTo(ProductLot::class, 'lot_id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id'); // Corrected foreign key
    }

    public function purchase_status(): BelongsTo
    {
        return $this->belongsTo(Purchase_status::class, 'status_id');
    }
}
