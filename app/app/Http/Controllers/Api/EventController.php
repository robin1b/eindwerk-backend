<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * GET /api/events
     * Haal alle events op, inclusief de organisator.
     */
    public function index(): JsonResponse
    {
        $events = Event::with('organizer')->orderBy('deadline')->get();
        return response()->json($events);
    }

    /**
     * POST /api/events
     * Alleen ingelogde gebruikers mogen events aanmaken.
     * Validatie gebeurt in StoreEventRequest.
     */
    public function store(StoreEventRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['organizer_id'] = $request->user()->id;

        if ($data['password_protected']) {
            $data['password_hash'] = bcrypt($data['password']);
        }

        $event = Event::create($data);
        return response()->json($event, 201);
    }

    /**
     * GET /api/events/{event}
     * Toon één event met relaties (organizer, giftIdeas, contributions, votes).
     */
    public function show(Event $event): JsonResponse
    {
        $event->load(['organizer', 'giftIdeas', 'contributions', 'votes']);
        return response()->json($event);
    }

    /**
     * PUT/PATCH /api/events/{event}
     * Alleen de organisator mag updaten.
     * Validatie gebeurt in UpdateEventRequest.
     */
    public function update(UpdateEventRequest $request, Event $event): JsonResponse
    {
        if ($request->user()->id !== $event->organizer_id) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $data = $request->validated();

        if (array_key_exists('password_protected', $data) && $data['password_protected']) {
            $data['password_hash'] = bcrypt($data['password']);
        }

        $event->update($data);
        return response()->json($event);
    }

    /**
     * DELETE /api/events/{event}
     * Alleen de organisator mag verwijderen.
     */
    public function destroy(Request $request, Event $event): JsonResponse
    {
        if ($request->user()->id !== $event->organizer_id) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $event->delete();
        return response()->json(null, 204);
    }
}
