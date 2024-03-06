<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function login(Request $request)
    {
        $credentials = $request->user;
        $token = Auth::attempt($credentials);

        if (!$token) {
            return response()->json([
                'message' => '認証に失敗しました。',
            ], 401);
        }

        $res = $this->userRes(Auth::user(), $token);
        return response()->json($res);
    }

    public function logout()
    {
        Auth::logout();
        return response()->json([
            'message' => 'ログアウトしました。',
        ]);
    }

    public function refresh()
    {
        $res = $this->userRes(Auth::user(), Auth::refresh());
        return response()->json($res);
    }

    private function userRes($user, $token)
    {
        return [
            'user' => [
                'email' => $user->email,
                'token' => $token,
                'username' => $user->username,
                'bio' => $user->bio,
                'image' => $user->image
            ]
        ];
    }
}
