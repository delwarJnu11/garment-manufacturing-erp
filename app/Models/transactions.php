<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class transactions extends Model
{
    protected $fillable = [
        'voucher_ref',
        'transaction_date',
        'account_id',
        'amount',
        'description',
        'transaction_against',
        'debit',
        'credit',
        'user_id',
    ];
}
