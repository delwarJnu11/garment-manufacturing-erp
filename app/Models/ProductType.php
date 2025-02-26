<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductType extends Model
{
    // Define the fillable columns for mass assignment
    protected $fillable = [
        'name',
    ];

   
}
