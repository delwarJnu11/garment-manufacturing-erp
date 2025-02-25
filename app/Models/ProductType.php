<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    // Define the fillable columns for mass assignment
    protected $fillable = [
        'name',
    ];
}
