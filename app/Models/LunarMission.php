<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class LunarMission extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'launch_details',
        'landing_details',
        'spacecraft',
    ];
    protected $casts = [
        'launch_details' => 'json',
        'landing_details' => 'json',
        'spacecraft' => 'json',
    ];
    //

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
