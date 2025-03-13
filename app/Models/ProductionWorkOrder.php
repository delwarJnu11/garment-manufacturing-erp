<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionWorkOrder extends Model
{
    use HasFactory;

    protected $fillable = ['production_plan_id', 'order_id', 'assigned_to', 'work_order_status_id', 'total_pieces', 'cutting_status', 'sewing_status', 'finishing_status', 'packaging_status', 'wastage'];

    public function productionPlan()
    {
        return $this->belongsTo(ProductionPlan::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    // public function workSection()
    // {
    //     return $this->belongsTo(ProductionWorkSection::class, 'production_work_section_id');
    // }

    public function workStatus()
    {
        return $this->belongsTo(ProductionWorkStatus::class, 'work_order_status_id');
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
