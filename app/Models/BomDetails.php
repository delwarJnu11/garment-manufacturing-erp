<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BomDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'bom_id',
        'material_id',
        'size_id',
        'quantity_used',
        'uom_id',
        'unit_price',
        'wastage',
    ];

    public function bom()
    {
        return $this->belongsTo(Bom::class, 'bom_id');
    }

    public function material()
    {
        return $this->belongsTo(Raw_material::class);
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function orderDetails()
    {
        return $this->hasOneThrough(OrderDetail::class, Bom::class, 'id', 'order_id', 'bom_id', 'order_id');
    }
}
