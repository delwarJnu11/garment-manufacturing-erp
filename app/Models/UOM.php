<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uom extends Model
{
    protected $table = 'uoms'; // Make sure this is set to 'uoms'
    use HasFactory;
    protected $fillable = ['name'];
}
