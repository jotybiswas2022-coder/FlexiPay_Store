<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentTransaction extends Model
{
    protected $fillable = [
        'user_id', 'order_id', 'installment_payment_id',
        'transaction_reference', 'gateway', 'gateway_reference',
        'amount', 'fee', 'currency', 'status', 'type',
        'gateway_response', 'metadata'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'fee' => 'decimal:2',
        'gateway_response' => 'array',
        'metadata' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function installmentPayment()
    {
        return $this->belongsTo(InstallmentPayment::class);
    }
}
