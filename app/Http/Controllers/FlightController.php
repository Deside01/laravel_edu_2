<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): array
    {
        return [
            'data' => Flight::query()->get()->map->data,
        ];
    }
}
