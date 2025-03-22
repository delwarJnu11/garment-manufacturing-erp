<?php

namespace App\Models;

use App\Models\OrderDetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'buyer_id',
        'supervisor_id',
        'status_id',
        'fabric_type_id',
        'gsm',
        'delivery_date',
        'description',
    ];

    protected $table = 'orders';

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }

    public function buyer()
    {
        return $this->belongsTo(Buyer::class, 'buyer_id');
    }
    public function status()
    {
        return $this->belongsTo(OrderStatus::class, 'status_id');
    }
    public function bom()
    {
        return $this->hasOne(Bom::class, 'order_id');
    }

    public function productionPlans()
    {
        return $this->hasMany(ProductionPlan::class, 'order_id');
    }
}
