<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstallmentPlan extends Model
{
    protected $fillable = [
        'name', 'type', 'duration', 'duration_days',
        'interest_rate', 'description', 'is_active', 'sort_order'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'interest_rate' => 'decimal:2',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function getPerInstallmentAmountAttribute($totalAmount)
    {
        return $totalAmount / $this->duration;
    }
}
