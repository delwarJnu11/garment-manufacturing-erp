<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hrm_departments extends Model
{
    public function statuses()
{
    return $this->belongsTo(Hrm_statuses::class);
}

// public function department()
// {
//     return $this->belongsTo(Hrm_departments::class);
// }

public function department()
{
    return $this->hasMany(Hrm_departments::class);
}

}
