<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesInvoiceDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'sales_invoice_id',
        'order_id',
        'qty',
        'unit_price',
        'percent_of_discount',
        'discount',
        'percent_of_vat',
        'vat',
    ];

    public function salesInvoice()
    {
        return $this->belongsTo(SalesInvoice::class, 'sales_invoice_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
    public function orderDetail()
    {
        return $this->belongsTo(OrderDetail::class, 'order_id');
    }

    public function product()
    {
        return $this->hasOneThrough(Product::class, OrderDetail::class, 'order_id', 'id', 'order_id', 'product_id');
    }

    public function size()
    {
        return $this->hasOneThrough(Size::class, OrderDetail::class, 'order_id', 'id', 'order_id', 'size_id');
    }
}
