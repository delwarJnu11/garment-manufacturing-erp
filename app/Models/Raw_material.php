<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Raw_material extends Model
{
    protected $fillable = [
        'material_name',
        'description',
        'quantity',
        'uom_id',
        'cost_per_unit',
        'supplier_id'
    ];

    function uom():BelongsTo{
        return $this->belongsTo(Uom::class,'uom_id');
    }
    function supplier():BelongsTo{
        return $this->belongsTo(inv_suppliers::class,'supplier_id');
    }

    public function bomDetails()
    {
        return $this->hasMany(BomDetails::class);
    }
}

