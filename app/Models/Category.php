<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

class Category extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name'
    ];

    // 'category_type_id',
    //         'name',
    //         'description',
    //         'status_id',

    /**
     * Define the relationship with Category_type.
     */
    // public function category_type(): BelongsTo
    // {
    //     return $this->belongsTo(Category_type::class, 'category_type_id');
    // }

    // public function status()
    // {
    //     return $this->belongsTo(Status::class, 'status_id');
    // }
}
