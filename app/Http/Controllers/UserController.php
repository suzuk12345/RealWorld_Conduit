<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['register']]);
    }

    // ユーザー登録
    public function register(Request $request)
    {
        $user = User::create([
            'username' => $request->input('user.username'),
            'email' => $request->input('user.email'),
            'password' => bcrypt($request->input('user.password')),
        ]);

        $credentials = $request->user;
        $token = Auth::attempt($credentials);

        $res = $this->userRes($user, $token);
        return response()->json($res);
    }

    // 現在のユーザー情報取得
    public function show(Request $request)
    {
        $res = $this->userRes(Auth::user(), Auth::tokenById(Auth::user()->id));
        return response()->json($res);
    }

    // ユーザー情報更新
    public function update(Request $request)
    {
        $user = User::find(Auth::user()->id);

        $user->email = $request->input('user.email');
        $user->username = $request->input('user.username');
        $user->password = bcrypt($request->input('user.password'));
        $user->bio = $request->input('user.bio');
        $user->image = $request->input('user.image');

        $user->save();

        $res = $this->userRes($user, Auth::tokenById(Auth::user()->id));
        return response()->json($res);
    }

    // レスポンス作成
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
