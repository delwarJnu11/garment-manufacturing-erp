<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hrm_employees extends Model
{
    protected $fillables = [
            'name',
            'email' ,
            'phone',
            'gender',
            'photo',
    ];
}
