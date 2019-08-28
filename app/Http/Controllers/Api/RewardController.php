<?php

namespace App\Http\Controllers\Api;

use App\Models\Achievement;
use App\Models\Reward;
use App\Models\User;
use App\Http\Controllers\Controller;

class RewardController extends Controller
{
    public function getAll()
    {
        return Reward::all();
    }

    public function getMy()
    {
        /**
         * @var $user User
         */
        $user = auth()->user();
        return $user->achievements()->scopes(['approved'])->get();
    }

    public function create(Achievement $achievement, User $user)
    {
        $user->achievements()->withTimestamps()->attach($achievement);
        return response()->json(['message' => 'rewarded successful'])->setStatusCode(201);
    }

    public function delete(Achievement $achievement, User $user)
    {
        if($user->achievements()->detach($achievement)) {
            return response()->json(['message' => 'reward removes successful'])->setStatusCode(204);
        }
        return response()->json(['message' => 'reward wasn`t removed'])->setStatusCode(400);
    }
}
