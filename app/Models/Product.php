<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    // Define the fillable columns for mass assignment
    protected $fillable = [
        'name',
        'product_type_id',//1=Raw materials, 2= Finished_goods
        'category_type_id',
        'size_id',
        'sku',
        'qty',
        'uom_id',
        'unit_price',
    ];
    function PurchaseDetail()
    {
        return $this->hasMany(PurchaseOrderDetail::class, 'purchase_id', 'id');
    }

    function product_type(): BelongsTo
    {
        return $this->belongsTo(ProductType::class, 'product_type_id');
    }
    function category_type(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_type_id');
    }
    function size(): BelongsTo
    {
        return $this->belongsTo(Size::class, 'size_id');
    }
    function uom(): BelongsTo
    {
        return $this->belongsTo(Uom::class, 'uom_id');
    }
    function purchaseDetails()
    {
        return $this->hasMany(PurchaseOrderDetail::class);
    }
}
