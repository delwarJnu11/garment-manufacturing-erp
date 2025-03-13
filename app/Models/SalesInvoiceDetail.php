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

    public function salesInvoice(){
        return $this->belongsTo(SalesInvoice::class,'sales_invoice_id');

    }
    // public function productionWorkOrder(){
    //     return $this->hasMany(ProductionWorkOrder::class,'production_work_order_id');

    // }
    public function productionWorkOrder()
    {
        return $this->belongsTo(ProductionWorkOrder::class, 'production_work_order_id');
    }
    


}
