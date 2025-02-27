<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
   use HasFactory;
   protected $fillable = ['product_id', 'order_id', 'size_id', 'color_id', 'qty', 'uom_id', 'subtotal'];
}
