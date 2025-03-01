<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BomDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'bom_id',
        'material_id',
        'size_id',
        'quantity_used',
        'unit_cost',
        'wastage',
    ];

    public function bom()
    {
        return $this->belongsTo(Bom::class);
    }

    public function material()
    {
        return $this->belongsTo(Raw_material::class);
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }
}
