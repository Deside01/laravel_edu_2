<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class LunarMissionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'mission.name' => 'required|string|max:255',
            'mission.launch_details.launch_date' => 'required|date_format:Y-m-d',
            'mission.launch_details.launch_site.name' => 'required',
            'mission.launch_details.launch_site.location.latitude' => 'required',
            'mission.launch_details.launch_site.location.longitude' => 'required',
            'mission.landing_details.landing_date' => 'required|date_format:Y-m-d',
            'mission.landing_details.landing_site.name' => 'required',
            'mission.landing_details.landing_site.coordinates.latitude' => 'required',
            'mission.landing_details.landing_site.coordinates.longitude' => 'required',
            'mission.spacecraft.command_module' => 'required',
            'mission.spacecraft.lunar_module' => 'required',
            'mission.spacecraft.crew' => 'required|array|min:1',
            'mission.spacecraft.crew.*.name' => 'required|string|max:255',
            'mission.spacecraft.crew.*.role' => 'required',
        ];
    }
}
