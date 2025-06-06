<?php

namespace Database\Factories;

use App\Models\RecommendedGift;
use App\Models\GiftIdea;
use Illuminate\Database\Eloquent\Factories\Factory;

class RecommendedGiftFactory extends Factory
{
    protected $model = RecommendedGift::class;

    public function definition(): array
    {
        return [
            'gift_idea_id' => GiftIdea::factory(),
            'affiliate_url' => $this->faker->url(),
        ];
    }
}
