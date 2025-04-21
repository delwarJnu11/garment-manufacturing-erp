<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wastage extends Model
{

    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'wastage_type_id',
        'work_order_id',
        'warehouse_id',
        'reported_by',
        'section',
        'quantity',
        'unit_price',
        'is_sellable',
        'remarks',
        'wastage_date'
    ];

    public function wastageType()
    {
        return $this->belongsTo(WastageType::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
