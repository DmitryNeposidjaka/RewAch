<?php

namespace App\Http\Controllers\Api;

use App\Models\Approve;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class ApproveController extends Controller
{
    public function getAll()
    {
        return Approve::all();
    }

    /**
     * @param Model $entity
     * @return \Illuminate\Http\JsonResponse
     */
    public function entityAllow(Model $entity)
    {
        /**
         * @var User $user
         */
        $user = auth()->user();
        if($user->approve($entity)) {
            return response()->json(['message' => 'approved'])->setStatusCode(202);
        }
        return response()->json(['message' => 'not approved'])->setStatusCode(400);
    }

    /**
     * @param Model $entity
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function entityDeny(Model $entity)
    {
        /**
         * @var User $user
         */
        $user = auth()->user();
        if($user->deny($entity)) {
            return response()->json(['message' => 'denied'])->setStatusCode(202);
        }
        return response()->json(['message' => 'not denied'])->setStatusCode(400);
    }
}
