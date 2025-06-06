<?php

namespace Database\Factories;

use App\Models\GiftIdea;
use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class GiftIdeaFactory extends Factory
{
    protected $model = GiftIdea::class;

    public function definition(): array
    {
        return [
            'event_id'           => Event::factory(),
            'title'              => $this->faker->words(3, true),
            'description'        => $this->faker->sentence(),
            'image_url'          => $this->faker->optional()->imageUrl(400, 300),
            'created_by_user_id' => User::factory(),
        ];
    }
}
