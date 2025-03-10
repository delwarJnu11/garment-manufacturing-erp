<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvSupplier extends Model
{
    use HasFactory;
    protected $fillable = ['first_name', 'last_name', 'bank_account_id', 'email', 'phone', 'address', 'photo'];
    public function bankAccount()
    {
        return $this->belongsTo(BankAccount::class, 'bank_account_id');
    }
}
