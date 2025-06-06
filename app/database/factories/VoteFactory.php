<?php

namespace Database\Factories;

use App\Models\Vote;
use App\Models\Event;
use App\Models\User;
use App\Models\GiftIdea;
use Illuminate\Database\Eloquent\Factories\Factory;

class VoteFactory extends Factory
{
    protected $model = Vote::class;

    public function definition(): array
    {
        return [
            'event_id'     => Event::factory(),
            'user_id'      => User::factory(),
            'gift_idea_id' => GiftIdea::factory(),
        ];
    }
}
