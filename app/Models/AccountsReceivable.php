<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccountsReceivable extends Model
{
     protected $fillable = ['customer_id', 'invoice_number', 'invoice_date', 'due_date', 'total_amount', 'amount_paid', 'status'];

}
