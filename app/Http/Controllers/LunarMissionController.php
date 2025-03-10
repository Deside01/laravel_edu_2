<?php

namespace App\Http\Controllers;

use App\Http\Requests\LunarMissionRequest;
use App\Http\Resources\LunarMissionResource;
use App\Http\Resources\SearchMissionResource;
use App\Models\LunarMission;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class LunarMissionController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return LunarMissionResource::collection(LunarMission::all());
    }

    public function search(): AnonymousResourceCollection
    {
        $query = \request()->input('query', '');

        $mission = LunarMission::query()->where('name', 'LIKE', "%{$query}%")
            ->orWhereJsonContains('spacecraft->crew', ['name' => $query])
            ->get();

        return SearchMissionResource::collection($mission);
    }

    public function store(LunarMissionRequest $request): JsonResponse
    {
        auth()->user()->lunarMissions()->create($request->validated('mission'));

        return response()->json([
            'data' => [
                'code' => 201,
                'message' => 'Миссия добавлена',
            ]
        ], 201);
    }

    public function deleteOne(LunarMission $mission_id): Response
    {
        $mission_id->delete();

        return response()->noContent();
    }

    public function updateOne(LunarMission $mission_id, LunarMissionRequest $request): Response
    {
        $mission_id->update($request->validated('mission'));

        return response()->noContent();
    }
}
