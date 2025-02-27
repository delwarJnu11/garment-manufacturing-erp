<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bom extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'material_cost', 'labor_cost', 'overhead_cost', 'utility_cost', 'total_cost'];
}
