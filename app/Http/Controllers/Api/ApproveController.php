<?php

namespace App\Http\Controllers\Api;

use App\Models\Achievement;
use App\Models\Approve;
use App\Http\Controllers\Controller;
use App\Models\User;

class ApproveController extends Controller
{
    public function getAll()
    {
        return Approve::all();
    }

    /**
     * @param Achievement $achievement
     * @return \Illuminate\Http\JsonResponse
     */
    public function achievementAllow(Achievement $achievement)
    {
        /**
         * @var User $user
         */
        $user = auth()->user();
        if($user->approve($achievement)) {
            return response()->json(['message' => 'approved']);
        }
        return response()->json(['message' => 'not approved']);
    }

    /**
     * @param Achievement $achievement
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function achievementDeny(Achievement $achievement)
    {
        /**
         * @var User $user
         */
        $user = auth()->user();
        if($user->deny($achievement)) {
            return response()->json(['message' => 'approved']);
        }
        return response()->json(['message' => 'not approved']);
    }
}
