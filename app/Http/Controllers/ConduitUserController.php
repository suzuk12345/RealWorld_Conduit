<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ConduitUser;

class ConduitUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        return response()->json(
            [
                'user' => [
                    'email' => $request->user()->email,
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}