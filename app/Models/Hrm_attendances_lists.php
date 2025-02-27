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
}
