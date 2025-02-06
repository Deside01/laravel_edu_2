<?php

namespace App\Policies;

use App\Models\LunarMission;
use App\Models\User;

class LunarMissionPolicy
{
    public function manage(User $user, LunarMission $mission): bool
    {
        return $user->id === $mission->user_id;
    }
}
