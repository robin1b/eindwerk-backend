<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EventFactory extends Factory
{
    protected $model = Event::class;

    public function definition(): array
    {
        return [
            'organizer_id'               => 1, // pas later aan via seeder
            'name'                       => $this->faker->sentence(3),
            'description'                => $this->faker->paragraph(),
            'deadline'                   => $this->faker->dateTimeBetween('+1 week', '+1 month'),
            'privacy'                    => $this->faker->randomElement(['public', 'private']),
            'password_protected'         => false,
            'password_hash'              => null,
            'anonymous_contributions'    => $this->faker->boolean(30),
            'show_contribution_breakdown' => true,
        ];
    }
}
