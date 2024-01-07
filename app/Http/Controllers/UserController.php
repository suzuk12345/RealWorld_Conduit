<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['register']]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function register(Request $request)
    {
        $user = User::create([
            'username' => $request->input('user.username'),
            'email' => $request->input('user.email'),
            'password' => bcrypt($request->input('user.password')),
        ]);

        return response()->json([
            'message' => 'ユーザーの作成に成功しました!',
            'user' => $user
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        return response()->json(
            [
                'user' => [
                    'username' => $request->user()->username,
                    'bio' => $request->user()->bio,
                    'image' => $request->user()->image,
                ]
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $user = User::find($request->user()->id);

        $user->email = $request->input('user.email');
        $user->username = $request->input('user.username');
        $user->password = bcrypt($request->input('user.password'));
        $user->bio = $request->input('user.bio');
        $user->image = $request->input('user.image');

        $user->save();

        return response()->json([
            'message' => 'ユーザー情報の更新に成功しました!',
            'user' => $user
        ]);
    }
}