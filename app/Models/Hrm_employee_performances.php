<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hrm_employee_performances extends Model
{
    public function department(){
        return $this->belongsTo(Hrm_departments::class);
    }

    public function designations(){
        return $this->belongsTo(Hrm_designations::class);
    }

    public function employees(){
        return $this->belongsTo(Hrm_employees::class);
    }

    public function statuses(){
        return $this->belongsTo(Hrm_statuses::class);
    }
}
