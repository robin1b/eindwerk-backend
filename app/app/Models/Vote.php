<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vote extends Model
{
    protected $fillable = [
        'event_id',
        'user_id',
        'gift_idea_id',
    ];

    // Een stem behoort tot één Event
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    // Een stem behoort tot één User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Een stem behoort tot één GiftIdea
    public function giftIdea(): BelongsTo
    {
        return $this->belongsTo(GiftIdea::class);
    }
}
