<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class GiftIdea extends Model
{
    protected $fillable = [
        'event_id',
        'title',
        'description',
        'image_url',
        'created_by_user_id',
    ];

    // Deze giftIdea behoort tot één Event
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    // Deze giftIdea is aangemaakt door één User
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }

    // Een giftIdea kan meerdere Votes hebben
    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class);
    }

    // Eventueel één RecommendedGift
    public function recommendedGift(): HasOne
    {
        return $this->hasOne(RecommendedGift::class);
    }
}
