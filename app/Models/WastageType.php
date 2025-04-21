<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WastageType extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function wastages()
    {
        return $this->hasMany(Wastage::class);
    }
}
