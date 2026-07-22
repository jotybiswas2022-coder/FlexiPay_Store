<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SavedCard extends Model
{
    protected $fillable = [
        'user_id', 'card_number_last4', 'card_holder_name',
        'expiry_month', 'expiry_year', 'card_brand',
        'gateway_reference', 'is_default'
    ];

    protected $casts = [
        'is_default' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
