<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGiftIdeaRequest;
use App\Http\Requests\UpdateGiftIdeaRequest;
use App\Models\GiftIdea;
use App\Models\Event;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GiftIdeaController extends Controller
{
    // POST /api/events/{event}/gift-ideas
    public function store(StoreGiftIdeaRequest $request, Event $event): JsonResponse
    {
        // $request->validated() bevat alleen ‘title’, ‘description’, ‘image_url’
        $data = $request->validated();
        $data['event_id'] = $event->id;
        $data['created_by_user_id'] = $request->user()->id;

        $idea = GiftIdea::create($data);
        return response()->json($idea, 201);
    }

    // PUT/PATCH /api/gift-ideas/{giftIdea}
    public function update(UpdateGiftIdeaRequest $request, GiftIdea $giftIdea): JsonResponse
    {
        if ($request->user()->id !== $giftIdea->created_by_user_id) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        // Update enkel de velden die gevalideerd zijn
        $giftIdea->update($request->validated());
        return response()->json($giftIdea);
    }
}
