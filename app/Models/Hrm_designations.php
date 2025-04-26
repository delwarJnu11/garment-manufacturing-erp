<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hrm_designations extends Model
{
    public function statuses()
    {
        return $this->belongsTo(Hrm_statuses::class, 'statuses_id');
    }

    public function department()
    {
        return $this->belongsTo(Hrm_departments::class, 'department_id');
    }
}
