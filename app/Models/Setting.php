<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'email', 'phone', 'location',
        'store_name', 'store_description', 'currency', 'currency_symbol',
        'default_interest_rate', 'cancellation_fee_percentage',
        'delivery_threshold_percentage', 'insurance_enabled',
        'primary_color', 'accent_color', 'logo', 'favicon',
        'meta_description', 'meta_keywords', 'timezone',
        'default_gateway', 'gateway_config', 'smtp_settings',
        'sms_settings', 'registration_enabled', 'guest_checkout'
    ];

    protected $casts = [
        'insurance_enabled' => 'boolean',
        'registration_enabled' => 'boolean',
        'guest_checkout' => 'boolean',
        'default_interest_rate' => 'decimal:2',
        'cancellation_fee_percentage' => 'decimal:2',
        'delivery_threshold_percentage' => 'decimal:2',
        'gateway_config' => 'array',
    ];
}
