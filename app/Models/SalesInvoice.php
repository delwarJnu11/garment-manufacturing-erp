<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesInvoice extends Model
{
    use HasFactory;
    protected $casts = [
        'sale_date' => 'datetime',
    ];


    protected $fillable = [
        'buyer_id',
        'sale_date',
        'total_amount',
        'paid_amount',
        'discount',
        'vat',
        'invoice_status_id',
        'payment_method_id',
        'payment_status_id',
    ];

    public function buyer()
    {
        return $this->belongsTo(Buyer::class, 'buyer_id');
    }
    public function invoice_status()
    {
        return $this->belongsTo(InvoiceStatus::class, 'invoice_status_id');
    }
    public function payment_method()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id');
    }

    public function salesInvoiceDetails()
    {
        return $this->hasMany(SalesInvoiceDetail::class, 'sales_invoice_id');
    }
}
