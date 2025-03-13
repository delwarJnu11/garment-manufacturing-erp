<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'production_plan_status_id',
        'production_line',
        'daily_target',
        'allocated_machines',
        'allocated_workers',
        'start_date',
        'end_date',
    ];

    function order(){
        return $this->belongsTo(Order::class, 'order_id');
    }

    function status(){
        return $this->belongsTo(Production_plan_statuses::class, 'production_plan_status_id');
    }

    function workOrders(){
        return $this->hasMany(ProductionWorkorder::class);
    }
}
