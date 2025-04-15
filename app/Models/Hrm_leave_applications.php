<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hrm_leave_applications extends Model
{
    use HasFactory;

    protected $table = 'hrm_leave_applications';
    protected $fillable = [
        'employee_id', 'leave_type_id', 'attendance_id', 'start_date', 'end_date',
        'number_of_days', 'reason', 'duration', 'statuses_id', 'approver_id', 'photo',
    ];

    // Automatically calculate the number of days before saving

    public function employee(){
        return $this->belongsTo(Hrm_employees::class);
    }
    public function leave_type(){
        return $this->belongsTo(Hrm_leave_types::class);
    }

}
