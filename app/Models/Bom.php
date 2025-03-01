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

    // Join with Order Table based on order_id
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function bomDetails()
    {
        return $this->hasMany(BomDetails::class);
    }
}
