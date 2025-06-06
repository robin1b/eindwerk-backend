<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVoteRequest;
use App\Models\Vote;
use App\Models\Event;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    // POST /api/events/{event}/votes
    public function store(StoreVoteRequest $request, Event $event): JsonResponse
    {
        $data = $request->validated(); // bevat ‘gift_idea_id’
        $data['event_id'] = $event->id;
        $data['user_id'] = $request->user()->id;

        // Voorkom dubbele stemmen van dezelfde user op hetzelfde cadeau binnen dit event
        $exists = Vote::where([
            ['event_id', $event->id],
            ['user_id', $data['user_id']],
            ['gift_idea_id', $data['gift_idea_id']],
        ])->exists();

        if ($exists) {
            return response()->json(['message' => 'Already voted'], 409);
        }

        $vote = Vote::create($data);
        return response()->json($vote, 201);
    }

    // DELETE /api/events/{event}/votes/{vote}
    public function destroy(Request $request, Event $event, Vote $vote): JsonResponse
    {
        if ($request->user()->id !== $vote->user_id) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $vote->delete();
        return response()->json(null, 204);
    }

    // index() etc. blijven hetzelfde
}
