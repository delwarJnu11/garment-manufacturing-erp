<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hrm_payslips extends Model
{
    public function department(){
        return $this->belongsTo(Hrm_departments::class);
    }
    public function employee(){
        return $this->belongsTo(Hrm_employees::class);
    }

    public function designations(){
        return $this->hasMany(Hrm_designations::class);
    }

    public function bank_accounts(){
        return $this->belongsTo(Hrm_employee_bank_accounts::class);
    }


}
