<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductCatelogue extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'sku', 'description', 'barcode', 'category_id', 'uom_id', 'photo'];


    function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    function uom(): BelongsTo
    {
        return $this->belongsTo(Uom::class, 'uom_id');
    }
    // function valuation_method(): BelongsTo
    // {
    //     return $this->belongsTo(Valuation_methods::class, 'valuation_method_id');
    // }
}
