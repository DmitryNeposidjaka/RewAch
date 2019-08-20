<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Requests\ApiLoginRequest;
use Carbon\Carbon;

class LoginController extends Controller
{


    public function __invoke(ApiLoginRequest $request)
    {
        $attempted = auth()->attempt($request->only(['email', 'password']));
        if (!$attempted) {
            return response()->json([
                'message' => 'You cannot sign with those credentials',
                'errors' => 'Unauthorised'
            ], 401);
        }
        $access = auth()->user()->createToken(config('app.name'));
        $access->token->expires_at = $request->input('remember', false) ?
            Carbon::now()->addMonth() :
            Carbon::now()->addDay();

        $access->token->save();

        return response()->json([
            'token_type' => 'Bearer',
            'token' => $access->accessToken,
            'expires_at' => Carbon::parse($access->token->expires_at)->toDateTimeString()
        ], 200);
    }
}