<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstallmentPayment extends Model
{
    protected $fillable = [
        'order_id', 'installment_number', 'amount', 'due_date',
        'paid_date', 'status', 'paid_amount', 'payment_method', 'notes'
    ];

    protected $casts = [
        'due_date' => 'date',
        'paid_date' => 'date',
        'amount' => 'decimal:2',
        'paid_amount' => 'decimal:2',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function transaction()
    {
        return $this->hasOne(PaymentTransaction::class, 'installment_payment_id');
    }
}
