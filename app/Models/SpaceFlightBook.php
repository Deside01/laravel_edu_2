<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpaceFlightBook extends Model
{
    protected $fillable = [
      'user_id',
      'flight_id',
    ];
}
