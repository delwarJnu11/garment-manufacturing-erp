<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Valuation_methods extends Model
{
   use HasFactory;
   protected $fillable =['method_name'];
}
