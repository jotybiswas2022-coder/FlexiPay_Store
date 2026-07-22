<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductFee extends Model
{
    protected $fillable = ['name', 'slug', 'amount', 'type', 'description', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
        'amount' => 'decimal:2',
    ];
}
