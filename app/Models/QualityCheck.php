<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QualityCheck extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'work_order_id',
        'total_quantity',
        'checked_quantity',
        'passed_quantity',
        'rejected_quantity',
        'remarks',
        'status',
        'checked_by',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function workOrder()
    {
        return $this->belongsTo(ProductionWorkOrder::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
