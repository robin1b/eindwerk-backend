<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreChatMessageRequest;
use App\Models\ChatMessage;
use App\Models\Event;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ChatMessageController extends Controller
{
    /**
     * GET /api/events/{event}/chat-messages
     * Haal alle chatberichten op voor een event, met de gebruiker erbij.
     */
    public function index(Request $request, Event $event): JsonResponse
    {
        $messages = $event->chatMessages()->with('user')->get();
        return response()->json($messages);
    }

    /**
     * POST /api/events/{event}/chat-messages
     * Alleen ingelogde gebruikers mogen berichten plaatsen.
     * Validatie gebeurt via StoreChatMessageRequest.
     */
    public function store(StoreChatMessageRequest $request, Event $event): JsonResponse
    {
        $data = $request->validated(); // bevat alleen 'message'
        $data['user_id'] = $request->user()->id;
        $data['event_id'] = $event->id;

        $message = ChatMessage::create($data);
        return response()->json($message, 201);
    }
}
