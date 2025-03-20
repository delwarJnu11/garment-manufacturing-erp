<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hrm_attendances_lists extends Model
{
    use HasFactory;

    protected $table = 'hrm_attendances_lists';

    protected $fillable = [
        'employee_id',
        'date',
        'statuses_id',
        'clock_in',
        'clock_out',
        'late_days',
        'leave_days',
        'late_times',
        'leave_times',
        'total_work_hours',
        'overtime_hours',
        'created_at',
        'updated_at',
    ];

    public $timestamps = false;

    public function statuses(){
        return $this->belongsTo(Hrm_statuses::class);
    }

    public function employee(){
        return $this->belongsTo(User::class);
    }

    public function employees(){
        return $this->belongsTo(Hrm_employees::class);
    }

}
