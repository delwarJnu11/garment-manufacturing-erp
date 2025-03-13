<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
   use HasFactory;
   protected $fillable = ['product_id', 'order_id', 'size_id', 'color_id', 'qty', 'uom_id', 'subtotal'];

   protected $table = 'order_details';

   public function product()
   {
      return $this->belongsTo(Product::class, 'product_id');
   }

   public function order()
   {
      return $this->belongsTo(Order::class, 'order_id');
   }

   public function size()
   {
      return $this->belongsTo(Size::class, 'size_id');
   }

   public function color()
   {
      return $this->belongsTo(Color::class, 'color_id');
   }

   public function uom()
   {
      return $this->belongsTo(Uom::class, 'uom_id');
   }
}
