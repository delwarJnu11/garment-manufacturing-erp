<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sweing extends Model
{
    use HasFactory;

    protected $fillable = [
        'cutting_id',
        'work_order_id',
        'sewing_status',
        'total_pieces',
        'target_quantity',
        'actual_quantity',
        'swen_complete',
        'wastage',
        'efficiency',
        'sewing_start_date',
        'sewing_end_date',
        'remarks',
    ];

    /**
     * Relationships
     */
    public function cutting()
    {
        return $this->belongsTo(Cutting::class);
    }

    public function workOrder()
    {
        return $this->belongsTo(ProductionWorkOrder::class);
    }
}
