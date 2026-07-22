<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExchangeRequest extends Model
{
    protected $fillable = [
        'user_id', 'order_id', 'current_product_id',
        'requested_product_id', 'reason', 'status', 'admin_notes'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function currentProduct()
    {
        return $this->belongsTo(Product::class, 'current_product_id');
    }

    public function requestedProduct()
    {
        return $this->belongsTo(Product::class, 'requested_product_id');
    }
}
