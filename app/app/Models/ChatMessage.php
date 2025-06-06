<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChatMessage extends Model
{
    protected $fillable = [
        'event_id',
        'user_id',
        'message',
    ];

    // Dit chatbericht behoort tot één Event
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    // Dit chatbericht behoort tot één User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
