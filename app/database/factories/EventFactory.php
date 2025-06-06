<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    protected $model = Event::class;

    public function definition(): array
    {
        return [
            'organizer_id'               => User::factory(),
            'name'                       => $this->faker->sentence(3),
            'description'                => $this->faker->paragraph(),
            'deadline'                   => $this->faker->dateTimeBetween('+1 week', '+1 month'),
            'privacy'                    => $this->faker->randomElement(['public', 'private']),
            'password_protected'         => $this->faker->boolean(20),
            'password_hash'              => function (array $attributes) {
                return $attributes['password_protected']
                    ? bcrypt($this->faker->password(6))
                    : null;
            },
            'anonymous_contributions'    => $this->faker->boolean(50),
            'show_contribution_breakdown' => $this->faker->boolean(80),
        ];
    }
}
