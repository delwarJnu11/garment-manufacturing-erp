<?php

namespace App\Models;

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
}
