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

    public function department()
{
    return $this->belongsTo(Hrm_departments::class, 'department_id');
}



    public function designations()
{
    return $this->belongsTo(Hrm_designations::class, 'designations_id');
}


    public function statuses()
{
    return $this->belongsTo(Hrm_statuses::class, 'statuses_id');
}

public function bank_accounts()
    {
        return $this->belongsTo(Hrm_employee_bank_accounts::class, 'bank_accounts_id');
    }

public function employee()
{
    return $this->belongsTo(Hrm_employees::class);
}

}
