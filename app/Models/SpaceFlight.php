<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SpaceFlight extends Model
{
    protected $fillable = [
        'flight_number',
        'destination',
        'launch_date',
        'seats_available',
    ];

    public function books(): HasMany
    {
        return $this->hasMany(SpaceFlightBook::class, 'flight_id', 'id');
    }
}
