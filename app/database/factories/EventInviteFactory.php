<?php

namespace Database\Factories;

use App\Models\EventInvite;
use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Carbon\Carbon;

class EventInviteFactory extends Factory
{
    protected $model = EventInvite::class;

    public function definition(): array
    {
        return [
            'event_id'  => Event::factory(),
            'email'     => $this->faker->unique()->safeEmail(),
            'code'      => Str::random(40),
            'expires_at' => Carbon::now()->addDays(rand(1, 7)),
        ];
    }
}
