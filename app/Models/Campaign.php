<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $fillable = [
        'name', 'subject', 'content', 'channel', 'audience',
        'recipient_filters', 'status', 'scheduled_at', 'sent_at'
    ];

    protected $casts = [
        'recipient_filters' => 'array',
        'scheduled_at' => 'datetime',
        'sent_at' => 'datetime',
    ];

    public function logs()
    {
        return $this->hasMany(CampaignLog::class);
    }
}
