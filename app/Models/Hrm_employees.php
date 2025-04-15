<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hrm_employees extends Model
{
    protected $fillables = [
        'employee_id_number',
        'joining_date',
        'bank_accounts_id',
        'date_of_birth',
        'department_id',
        'salary',
        'branch',
        'resume',
        'certificate',
        'designations_id',
        'statuses_id',
        'address',
        'city',
        'name',
        'email' ,
        'phone',
        'gender',
        'photo',
    ];
}
