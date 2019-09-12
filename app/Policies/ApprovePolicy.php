<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Reward;
use App\Models\Achievement;
use Illuminate\Auth\Access\HandlesAuthorization;

class ApprovePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @param User $user
     * @param Achievement $entity
     * @return bool
     */
    public function allowAchievement(User $user, Achievement $entity)
    {
        return $user->hasPermissionTo('approve achievement allow', 'api') and $entity->authorIsNot($user);
    }

    public function allowReward(User $user, Reward $entity)
    {
        return $user->hasPermissionTo('approve reward allow', 'api') and $entity->userISNot($user);
    }
}
