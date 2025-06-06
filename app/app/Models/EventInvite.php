<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class EventInvite extends Model
{
    use HasFactory;
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
