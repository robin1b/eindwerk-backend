<?php

namespace Database\Factories;

use App\Models\ChatMessage;
use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChatMessageFactory extends Factory
{
    protected $model = ChatMessage::class;

    public function definition(): array
    {
        return [
            'event_id' => Event::factory(),
            'user_id'  => User::factory(),
            'message'  => $this->faker->sentences(2, true),
        ];
    }
}
