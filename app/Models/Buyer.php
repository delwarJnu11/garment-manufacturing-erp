<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buyer extends Model
{
    use HasFactory;
    protected $fillable = ['first_name', 'last_name', 'bank_account_id', 'email', 'phone', 'country', 'billing_address', 'shipping_address', 'photo'];

    public function orders()
    {
        return $this->hasMany(Order::class, 'buyer_id');
    }
    public function bankAccount()
    {
        return $this->belongsTo(BankAccount::class, 'bank_account_id');
    }
}
