<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InsuranceSetting extends Model
{
    protected $fillable = ['name', 'rate', 'type', 'is_enabled', 'description'];

    protected $casts = [
        'is_enabled' => 'boolean',
        'rate' => 'decimal:2',
    ];
}
