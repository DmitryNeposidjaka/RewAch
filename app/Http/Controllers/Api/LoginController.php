<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Requests\ApiLoginRequest;
use App\Models\User;
use Carbon\Carbon;

/**
 * Class LoginController
 * @package App\Http\Controllers\Api
 */
class LoginController extends Controller
{
    /**
     * @param ApiLoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(ApiLoginRequest $request)
    {
        $attempted = auth()->attempt($request->only(['email', 'password']));
        if (!$attempted) {
            return response()->json([
                'message' => 'You cannot sign with those credentials',
                'errors' => 'Unauthorised'
            ], 401);
        }
        /**
         * @var $user User
         */
        $user = auth()->user();
        $access = $user->createToken(config('app.name'));
        $access->token->expires_at = $request->input('remember', false) ?
            Carbon::now()->addMonth() :
            Carbon::now()->addDay();

        $access->token->save();

        if ($user->hasPermissionTo('to login', 'api') or $user->hasRole('superadmin')) {
            return response()->json([
                'token_type' => 'Bearer',
                'token' => $access->accessToken,
                'expires_at' => Carbon::parse($access->token->expires_at)->toDateTimeString()
            ], 200);
        } else {
            return response()->json([
                'message' => 'You allowed to login',
                'errors' => 'Unauthorised'
            ], 403);
        }

    }
}