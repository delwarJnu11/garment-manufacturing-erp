<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesInvoiceDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'sales_invoice_id',
        'production_work_order_id',
        'qty',
        'unit_price',
        '%_of_discount',
        'discount',
        '%_of_vat',
        'vat',
    ];
}
