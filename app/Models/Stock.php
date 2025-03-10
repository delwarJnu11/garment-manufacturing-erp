<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Stock extends Model
{
    protected $fillable = [
        'product_id',
        'warehouse_id',
        'transaction_type_id',
        'qty',
        'lot_id',
        'total_value'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // public function warehouse()
    // {
    //     return $this->belongsTo(Warehouse::class);
    // }
    public function transactionType()
    {
        return $this->belongsTo(TransactionType::class, 'transaction_type_id');
    }
    public function lot()
    {
        return $this->belongsTo(ProductLot::class, 'lot_id');
    }
}
