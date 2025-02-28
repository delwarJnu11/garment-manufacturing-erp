<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hrm_employee_timesheets extends Model
{
    protected $fillables=[
        'employee_id',
        'date',
        'statuses_id',
        'clock_in',
        'clock_out',
        'overtime_hours',
        'shift_start',
        'shift_end',
        'break_duration',
        'total_work_hours',
        'remarks',
    ];
}
