<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRecommendedGiftRequest;
use App\Http\Requests\UpdateRecommendedGiftRequest;
use App\Models\RecommendedGift;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RecommendedGiftController extends Controller
{
    // POST /api/recommended-gifts
    public function store(StoreRecommendedGiftRequest $request): JsonResponse
    {
        // $request->validated() bevat ‘gift_idea_id’ en ‘affiliate_url’
        $rec = RecommendedGift::create($request->validated());
        return response()->json($rec, 201);
    }

    // PUT/PATCH /api/recommended-gifts/{recommendedGift}
    public function update(UpdateRecommendedGiftRequest $request, RecommendedGift $recommendedGift): JsonResponse
    {
        $recommendedGift->update($request->validated());
        return response()->json($recommendedGift);
    }
}
