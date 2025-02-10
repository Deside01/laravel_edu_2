<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SpaceFlightRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'flight_number' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'launch_date' => 'required|date_format:Y-m-d',
            'seats_available' => 'required|integer|min:1',
        ];
    }
}
