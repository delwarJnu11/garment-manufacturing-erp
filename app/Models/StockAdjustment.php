<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockAdjustment extends Model
{
    use HasFactory;

    protected $fillable = [
        'stock_id',
        'adjustment_type_id',
        'adjusted_qty',
        'remaining_qty',
        'reason',
    ];
    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }

    public function adjustmentType()
    {
        return $this->belongsTo(AdjustmentType::class, 'adjustment_type_id');
    }
}
