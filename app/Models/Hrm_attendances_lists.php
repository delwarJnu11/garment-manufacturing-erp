<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hrm_attendances_lists extends Model
{
    protected $fillables=[
        'employee_id',
        'date',
        'statuses_id',
        'clock_in',
        'clock_out',
        'late_days',
        'leave_days',
        'late_times',
        'leave_times',
        'overtime_hours',
    ];

    public function statuses(){
        return $this->belongsTo(Hrm_statuses::class);
    }

    public function employee(){
        return $this->belongsTo(User::class);
    }


}
