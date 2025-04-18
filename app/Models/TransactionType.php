<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionType extends Model
{
    use HasFactory;

    protected $table = 'transaction_types';

    protected $fillable = [
        'name',
        'movement_type_id',
    ];

    public $timestamps = true; 
}
