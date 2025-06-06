<?php

namespace Database\Factories;

use App\Models\Contribution;
use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContributionFactory extends Factory
{
    protected $model = Contribution::class;

    public function definition(): array
    {
        return [
            'event_id' => Event::factory(),
            'user_id'  => User::factory(),
            'amount'   => $this->faker->randomFloat(2, 5, 100),
            'anonymous' => $this->faker->boolean(30),
        ];
    }
}
