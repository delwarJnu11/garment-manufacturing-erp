<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Packaging extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'work_order_id',
        'product_id',
        'total_quantity',
        'packaged_quantity',
        'remarks',
        'status',
        'packaging_start',
        'packaging_end',
        'packaged_by',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function workOrder()
    {
        return $this->belongsTo(ProductionWorkOrder::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'packaged_by');
    }
}
