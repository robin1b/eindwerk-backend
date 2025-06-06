<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventInvite extends Model
{
    protected $fillable = [
        'event_id',
        'email',
        'code',
        'expires_at',
    ];

    // Deze invite behoort tot één Event
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
}
