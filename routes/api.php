<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\GagarinController;
use App\Http\Controllers\LunarMissionController;
use App\Http\Controllers\SpaceFlightController;
use Illuminate\Support\Facades\Route;

Route::post('registration', AuthController::class . '@registration');
Route::post('authorization', AuthController::class . '@authorization');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('logout', AuthController::class . '@logout');
    Route::get('api/gagarin-flight', GagarinController::class);
    Route::get('flight', FlightController::class);

    Route::get('lunar-missions', LunarMissionController::class . '@index');
    Route::post('lunar-missions', LunarMissionController::class . '@store');
    Route::delete('lunar-missions/{mission_id}', LunarMissionController::class . '@deleteOne')->can('manage,mission_id',);
    Route::patch('lunar-missions/{mission_id}', LunarMissionController::class . '@updateOne')->can('manage,mission_id',);

    Route::get('search', LunarMissionController::class . '@search');

    Route::post('space-flights', SpaceFlightController::class . '@store');
    Route::get('space-flights', SpaceFlightController::class . '@index');

    Route::post('book-flight', SpaceFlightController::class . '@books');

});
