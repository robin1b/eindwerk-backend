<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Contribution extends Model
{
    use HasFactory;
    protected $fillable = [
        'event_id',
        'user_id',
        'amount',
        'anonymous',
    ];

    // Deze bijdrage behoort tot één Event
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    // Deze bijdrage behoort tot één User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
