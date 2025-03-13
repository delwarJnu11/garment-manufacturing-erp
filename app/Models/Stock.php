<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Stock extends Model
{
    protected $fillable = [
        'product_id',
        // 'warehouse_id',
        'transaction_type_id',
        'quantity', //from lot get qty
        'lot_id',
        'total_value' //from lot get qty and * price get value
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function transactionType()
    {
        return $this->belongsTo(TransactionType::class, 'transaction_type_id');
    }
    public function lot()
    {
        return $this->belongsTo(ProductLot::class, 'lot_id');
    }
    public function adjustments()
    {
        return $this->hasMany(StockAdjustment::class);
    }
}
