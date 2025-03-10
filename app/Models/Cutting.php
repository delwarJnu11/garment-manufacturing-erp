<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cutting extends Model
{
    use HasFactory;

    protected $fillable = [
        'work_order_id',
        'cutting_status_id',
        'total_fabric_quantity',
        'total_fabric_used',
        'target_quantity',
        'actual_quantity',
        'cutting_start_date',
        'cutting_end_date',
        'wastage',
        'remarks'
    ];
}
