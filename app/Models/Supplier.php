<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'name', 'email', 'phone', 'address',
        'api_endpoint', 'api_key', 'api_secret',
        'meta_data', 'is_active'
    ];

    protected $casts = [
        'meta_data' => 'array',
        'is_active' => 'boolean',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
