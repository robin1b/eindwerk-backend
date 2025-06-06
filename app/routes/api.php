<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\GiftIdeaController;
use App\Http\Controllers\Api\ContributionController;
use App\Http\Controllers\Api\VoteController;
use App\Http\Controllers\Api\EventInviteController;
use App\Http\Controllers\Api\RecommendedGiftController;
use App\Http\Controllers\Api\ChatMessageController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Hier staan al onze “headless” API‐endpoints, beschermd door Sanctum.
| Elke route in deze groep vereist een geldige Sanctum‐cookie of token.
|
*/

Route::middleware('auth:sanctum')->group(function () {

    // EVENTS
    // ───────────────────────────────────────────────────────────────────────

    // Volledige CRUD voor events:
    Route::apiResource('events', EventController::class);

    // GIFT IDEAS (nested onder events)
    // ───────────────────────────────────────────────────────────────────────

    // GET    /api/events/{event}/gift-ideas
    // POST   /api/events/{event}/gift-ideas
    // GET    /api/gift-ideas/{giftIdea}
    // PUT    /api/gift-ideas/{giftIdea}
    // DELETE /api/gift-ideas/{giftIdea}
    Route::apiResource('events.gift-ideas', GiftIdeaController::class);

    // CONTRIBUTIONS (nested onder events)
    // ───────────────────────────────────────────────────────────────────────

    // Alleen index (lijst) en store (aanmaken) zijn nodig voor MVP:
    // GET  /api/events/{event}/contributions
    // POST /api/events/{event}/contributions
    Route::apiResource('events.contributions', ContributionController::class)
        ->only(['index', 'store']);

    // VOTES (nested onder events)
    // ───────────────────────────────────────────────────────────────────────

    // GET     /api/events/{event}/votes      (stemmen overzicht per gift)
    // POST    /api/events/{event}/votes      (nieuwe stem uitbrengen)
    // DELETE  /api/events/{event}/votes/{vote}
    Route::apiResource('events.votes', VoteController::class)
        ->only(['index', 'store', 'destroy']);

    // INVITES (nested onder events)
    // ───────────────────────────────────────────────────────────────────────

    // GET  /api/events/{event}/invites    (lijst uitnodigingen, enkel organizer)
    // POST /api/events/{event}/invites    (nieuwe uitnodiging aanmaken, enkel organizer)
    Route::apiResource('events.invites', EventInviteController::class)
        ->only(['index', 'store']);

    // POST /api/events/{event}/join       (gebruikers ‘joinen’ met code)
    Route::post('events/{event}/join', [EventInviteController::class, 'join']);

    // CHAT MESSAGES (nested onder events)
    // ───────────────────────────────────────────────────────────────────────

    // GET  /api/events/{event}/chat-messages   (alle chatberichten)
    // POST /api/events/{event}/chat-messages   (nieuw bericht plaatsen)
    Route::apiResource('events.chat-messages', ChatMessageController::class)
        ->only(['index', 'store']);

    // RECOMMENDED GIFTS (losstaande resource)
    // ───────────────────────────────────────────────────────────────────────

    // Volledige CRUD voor aanbevolen cadeaus:
    // GET    /api/recommended-gifts
    // POST   /api/recommended-gifts
    // GET    /api/recommended-gifts/{recommendedGift}
    // PUT    /api/recommended-gifts/{recommendedGift}
    // DELETE /api/recommended-gifts/{recommendedGift}
    Route::apiResource('recommended-gifts', RecommendedGiftController::class);
});
