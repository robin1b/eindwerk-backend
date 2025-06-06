<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Event;
use App\Models\GiftIdea;
use App\Models\Contribution;
use App\Models\Vote;
use App\Models\EventInvite;
use App\Models\RecommendedGift;
use App\Models\ChatMessage;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1) Maak eerst een test‐user aan (organisator)
        $organizer = User::factory()->create([
            'name'     => 'Admin Gebruiker',
            'email'    => 'admin@domain.test',
            'password' => bcrypt('secret123'),
        ]);

        // 2) Maak 3 extra gebruikers aan voor deelnemers
        $participants = User::factory()->count(3)->create();

        // 3) Maak 5 events aan voor die organisator
        $events = Event::factory()
            ->count(5)
            ->create([
                'organizer_id' => $organizer->id,
            ]);

        // 4) Voor elk event: maak bijbehorende sub‐data
        $events->each(function (Event $event) use ($participants) {
            // 4a) Voor elk event: maak 3 gift ideas
            $ideas = GiftIdea::factory()
                ->count(3)
                ->create([
                    'event_id'           => $event->id,
                    'created_by_user_id' => $participants->random()->id,
                ]);

            // 4b) Voor elke gift idea: maak 2 recommended gifts
            $ideas->each(function (GiftIdea $idea) {
                RecommendedGift::factory()->create([
                    'gift_idea_id' => $idea->id,
                ]);
            });

            // 4c) Voor elk event: maak 5 contributions (random deelnemers)
            Contribution::factory()
                ->count(5)
                ->create([
                    'event_id' => $event->id,
                    'user_id'  => $participants->random()->id,
                ]);

            // 4d) Nóg  unieke votes per event
            //    – haal alle user‐ en giftIdea‐IDs op
            $userIds = $participants->pluck('id')->toArray();
            $ideaIds = $ideas->pluck('id')->toArray();

            //    – maak een lijst van alle mogelijke (user, giftIdea) combinaties
            $combinations = [];
            foreach ($userIds as $uid) {
                foreach ($ideaIds as $gid) {
                    $combinations[] = [
                        'event_id'     => $event->id,
                        'user_id'      => $uid,
                        'gift_idea_id' => $gid,
                    ];
                }
            }

            //    – schud de array en neem de eerste 5 unieke combinaties
            shuffle($combinations);
            $selected = array_slice($combinations, 0, 5);

            //    – maak bij elke combinatie één vote
            foreach ($selected as $data) {
                Vote::factory()->create($data);
            }


            // 4e) Voor elk event: maak 2 invites
            EventInvite::factory()
                ->count(2)
                ->create([
                    'event_id' => $event->id,
                ]);

            // 4f) Voor elk event: maak 5 chatberichten
            ChatMessage::factory()
                ->count(5)
                ->create([
                    'event_id' => $event->id,
                    'user_id'  => $participants->random()->id,
                ]);
        });
    }
}
