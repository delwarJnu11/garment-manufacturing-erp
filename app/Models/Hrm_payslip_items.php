<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hrm_payslip_items extends Model
{
    protected $fillables=[
        'name',
        'employee_id',
        'factor',
        'amount',
    ];
}
