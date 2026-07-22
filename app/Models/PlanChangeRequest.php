<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanChangeRequest extends Model
{
    protected $fillable = [
        'user_id', 'order_id', 'current_plan_id',
        'requested_plan_id', 'reason', 'status',
        'admin_notes', 'approved_at', 'rejected_at'
    ];

    protected $casts = [
        'approved_at' => 'datetime',
        'rejected_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function currentPlan()
    {
        return $this->belongsTo(InstallmentPlan::class, 'current_plan_id');
    }

    public function requestedPlan()
    {
        return $this->belongsTo(InstallmentPlan::class, 'requested_plan_id');
    }
}
