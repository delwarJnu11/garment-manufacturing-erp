<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buyer extends Model
{
    use HasFactory;
    protected $fillable = ['first_name', 'last_name', 'email', 'phone', 'country', 'billing_address', 'shipping_address', 'photo'];
}
