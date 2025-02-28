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
        'product_variant_id',
        'quantity',
        'cost_price',
        'warehouse_id',
        'description',
    ];

    // function product_variant(): BelongsTo
    // {
    //     return $this->belongsTo(ProductVariant::class, 'product_variant_id');
    // }
    // function warehouse(): BelongsTo
    // {
    //     return $this->belongsTo(Warehouse::class, 'warehouse_id');
    // }
    public function productVariant(): BelongsTo
    {
        return $this->belongsTo(ProductVariant::class, 'product_variant_id');
    }

    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_id');
    }
}
