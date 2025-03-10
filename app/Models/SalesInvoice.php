<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesInvoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'buyer_id',
        'sale_date',
        'total_amount',
        'paid_amount',
        'discount',
        'vat',
        'invoice_status_id',
        'remark',
    ];
}
