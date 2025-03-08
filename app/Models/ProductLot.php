<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductLot extends Model
{
    use HasFactory;

    // Add raw_material_id to the fillable array
    protected $fillable = [
        'product_id',
        'qty',
        'cost_price',
        'sales_price',
        'warehouse_id',
        'transaction_type_id',
        'description',
    ];
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_id');
    }
    public function transactionType(): BelongsTo
    {
        return $this->belongsTo(TransactionType::class, 'transaction_type_id');
    }
}
