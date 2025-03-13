<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PurchaseOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_id',
        'status_id',
        'total_amount',
        'paid_amount',
        'lot_id',
        'discount',
        'vat',
        'purchase_date',
        'delivery_date',
        'shipping_address',
        'payment_method',
        'payment_status_id',
        'description',
    ];

    /**
     * Get the supplier associated with the purchase order.
     */
    public function inv_supplier(): BelongsTo
    {
        return $this->belongsTo(InvSupplier::class, 'supplier_id');
    }

    /**
     * Get the product lot associated with the purchase order.
     */
    public function product_lot(): BelongsTo
    {
        return $this->belongsTo(ProductLot::class, 'lot_id');
    }

    /**
     * Get the status of the purchase order.
     */
    public function purchase_status(): BelongsTo
    {
        return $this->belongsTo(InvoiceStatus::class, 'status_id');
    }

    /**
     * Get the purchase details associated with the purchase order.
     */
    public function purchaseDetails(): HasMany
    {
        return $this->hasMany(PurchaseOrderDetail::class, 'purchase_id');
    }

    public function getDueAmountAttribute()
    {
        return $this->total_amount - $this->paid_amount;
    }
    public function getPaymentStatusAttribute()
    {
        if ($this->paid_amount == 0) {
            return "Due";
        } elseif ($this->paid_amount < $this->total_amount) {
            return "Partially Paid"; // Fixed casing
        } else {
            return "Paid"; // Fixed casing
        }
    }
}
