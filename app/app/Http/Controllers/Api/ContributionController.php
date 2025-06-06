<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContributionRequest;
use App\Models\Contribution;
use App\Models\Event;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContributionController extends Controller
{
    /**
     * GET /api/events/{event}/contributions
     * Iedereen mag de lijst bijdragen zien (optioneel: organizer alleen).
     */
    public function index(Request $request, Event $event): JsonResponse
    {
        $contributions = $event->contributions()->with('user')->get();
        return response()->json($contributions);
    }

    /**
     * POST /api/events/{event}/contributions
     * Alleen ingelogde gebruikers mogen bijdragen.
     * Validatie gebeurt via StoreContributionRequest.
     */
    public function store(StoreContributionRequest $request, Event $event): JsonResponse
    {
        $data = $request->validated(); // bevat 'amount' en 'anonymous'
        $data['user_id'] = $request->user()->id;
        $data['event_id'] = $event->id;

        $contribution = Contribution::create($data);
        return response()->json($contribution, 201);
    }
}
