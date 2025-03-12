<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionWorkOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'production_plan_id',
        'production_work_section_id',
        'production_work_status_id',
        'assigned_to',
        'target_quantity',
        'actual_quantity',
        'created_at',
        'updated_at',
    ];
    public function productionPlan()
    {
        return $this->belongsTo(ProductionPlan::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class,'order_id');
    }

    public function workSection()
    {
        return $this->belongsTo(ProductionWorkSection::class, 'production_work_section_id');
    }

    public function workStatus()
    {
        return $this->belongsTo(ProductionWorkStatus::class, 'production_work_status_id');
    }

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
    public function salesInvoiceDetail()
{
    return $this->hasMany(SalesInvoiceDetail::class, 'production_work_order_id'); // Ensure this is correct
}

    
}
