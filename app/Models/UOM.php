<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uom extends Model
{
    // Make sure this is set to 'uoms'
    protected $table = 'uoms';
    use HasFactory;
    protected $fillable = ['name'];
}
