<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventInviteRequest;
use App\Models\Event;
use App\Models\EventInvite;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class EventInviteController extends Controller
{
    // POST /api/events/{event}/invites
    public function store(StoreEventInviteRequest $request, Event $event): JsonResponse
    {
        // Alleen de organisator mag invites maken; check in controller:
        if ($request->user()->id !== $event->organizer_id) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $data = $request->validated(); // bevat ‘email’
        $data['event_id'] = $event->id;
        $data['code'] = Str::random(40);
        $data['expires_at'] = Carbon::now()->addDays(7);

        $invite = EventInvite::create($data);

        // Optioneel: stuur hier een e-mail met de link of code
        return response()->json($invite, 201);
    }

    // POST /api/events/{event}/join (werkt niet via FormRequest)
    public function join(Request $request, Event $event): JsonResponse
    {
        $code = $request->input('code');
        $invite = EventInvite::where('event_id', $event->id)
            ->where('code', $code)
            ->where('expires_at', '>', Carbon::now())
            ->first();

        if (! $invite) {
            return response()->json(['message' => 'Invalid or expired code'], 404);
        }

        // Logica voor “joinen” (bijv. opslaan in een pivot‐tabel). Voor MVP:
        return response()->json(['message' => 'Joined successfully']);
    }
}
