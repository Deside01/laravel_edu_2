<?php

namespace App\Http\Controllers;

use App\Http\Requests\SpaceFlightRequest;
use App\Models\SpaceFlight;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SpaceFlightController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'data' => SpaceFlight::query()
                ->select("flight_number", "destination", "launch_date", "seats_available")
                ->get(),
        ]);
    }

    public function store(SpaceFlightRequest $request): JsonResponse
    {
        SpaceFlight::query()->create($request->validated());

        return response()->json([
            'data' => [
                'code' => 201,
                'message' => 'Космический полет создан'
            ]
        ], 201);
    }

    public function books() {
        \request()->validate([
            'flight_number' => 'required|string',
        ]);

        $flight = SpaceFlight::query()->where('flight_number', \request('flight_number'))->first();

        if (!$flight) {
            throw new NotFoundHttpException();
        }
        $flight->books()->create([
            'user_id' => auth()->id(),
        ]);

        return response()->json([
            'data' => [
                'code' => 201,
                'message' => 'Рейс забронирован'
            ]
        ], 201);
    }
}
