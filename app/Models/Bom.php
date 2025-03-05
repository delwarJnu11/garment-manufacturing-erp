<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bom extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'material_cost',
        'labour_cost',
        'overhead_cost',
        'utility_cost',
        'total_cost',
    ];

    public function calculateMaterialCost($size_id)
    {
        return $this->bomDetails()->where('size_id', $size_id)->get()->sum(function ($detail) {
                return ($detail->quantity_used + $detail->wastage) * $detail->unit_price;
            });
    }

    public function calculateTotalCost($size_id)
    {
        return $this->calculateMaterialCost($size_id) + $this->labour_cost + $this->overhead_cost + $this->utility_cost;
    }

    // Relationship with Order Table
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    // Relationship with BOM Details
    public function bomDetails()
    {
        return $this->hasMany(BomDetails::class, 'bom_id');
    }

    public function orderDetails()
    {
        return $this->hasManyThrough(OrderDetail::class, Order::class, 'id', 'order_id', 'order_id', 'id');
    }
}