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
*/

Route::middleware('auth:sanctum')->group(function () {

    // Events
    Route::apiResource('events', EventController::class);

    // Cadeausuggesties gelinkt aan event: nested resource
    Route::apiResource('events.gift-ideas', GiftIdeaController::class);

    // Contributions (alleen index en store)
    Route::apiResource('events.contributions', ContributionController::class)
        ->only(['index', 'store']);

    // Votes (index, store, destroy)
    Route::apiResource('events.votes', VoteController::class)
        ->only(['index', 'store', 'destroy']);

    // Invites
    Route::apiResource('events.invites', EventInviteController::class)
        ->only(['index', 'store']);
    // Join via code
    Route::post('events/{event}/join', [EventInviteController::class, 'join']);

    // Chat messages
    Route::apiResource('events.chat-messages', ChatMessageController::class)
        ->only(['index', 'store']);

    // Recommended gifts (admin)
    Route::apiResource('recommended-gifts', RecommendedGiftController::class);
});
