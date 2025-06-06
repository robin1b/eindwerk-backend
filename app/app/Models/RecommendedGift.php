<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class RecommendedGift extends Model
{
    use HasFactory;
    protected $fillable = [
        'gift_idea_id',
        'affiliate_url',
    ];

    // Dit aanbevolen cadeau behoort tot één GiftIdea
    public function giftIdea(): BelongsTo
    {
        return $this->belongsTo(GiftIdea::class);
    }
}
