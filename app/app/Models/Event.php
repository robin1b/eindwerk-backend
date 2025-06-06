<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Event extends Model
{
    use HasFactory;
    protected $fillable = [
        'organizer_id',
        'name',
        'description',
        'deadline',
        'privacy',
        'password_protected',
        'password_hash',
        'anonymous_contributions',
        'show_contribution_breakdown',
    ];

    // Dit event hoort bij één User (organisator)
    public function organizer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'organizer_id');
    }

    // Een event heeft meerdere GiftIdeas
    public function giftIdeas(): HasMany
    {
        return $this->hasMany(GiftIdea::class);
    }

    // Een event heeft meerdere Contributions
    public function contributions(): HasMany
    {
        return $this->hasMany(Contribution::class);
    }

    // Een event heeft meerdere Votes
    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class);
    }

    // Een event heeft meerdere EventInvites
    public function invites(): HasMany
    {
        return $this->hasMany(EventInvite::class);
    }

    // Een event heeft meerdere ChatMessages
    public function chatMessages(): HasMany
    {
        return $this->hasMany(ChatMessage::class);
    }
}
