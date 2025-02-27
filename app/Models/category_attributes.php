<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class category_attributes extends Model
{
    use HasFactory;
    protected $filable = [
        'category_id',
        'category_type_id',
        'name',
        'attribute_value'
    ];

    function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    function category_type(): BelongsTo
    {
        return $this->belongsTo(Category_type::class, 'category_type_id');
    }
}
