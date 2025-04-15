<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Psy\Command\WhereamiCommand;

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

    function account(){
        return $this->belongsTo(Account::class);
    }
    function accountAgainst(){
        return $this->belongsTo(Account::class, "transaction_against");
    }
}
