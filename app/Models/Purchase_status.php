<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase_status extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description']; // ✅ Add this line
}
