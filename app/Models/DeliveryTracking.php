<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryTracking extends Model
{
    protected $fillable = [
        'order_id', 'status', 'location', 'description',
        'tracking_number', 'carrier', 'tracked_at'
    ];

    protected $casts = [
        'tracked_at' => 'datetime',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
