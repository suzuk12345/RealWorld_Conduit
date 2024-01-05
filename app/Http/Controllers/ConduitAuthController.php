<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ConduitUser;

class ConduitAuthController extends Controller
{
    public function login(Request $request)
    {
        $user = ConduitUser::where('email', $request->email)->first();

        if (!$user || !password_verify($request->password, $user->password)) {
            return response([
                'message' => ['認証情報が異なります']
            ], 404);
        }

        $token = $user->createToken('AccessToken')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token
        ];
        return response($response, 201);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'ログアウトしました。'], 200);
    }
}
