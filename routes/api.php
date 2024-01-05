<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConduitAuthController;
use App\Http\Controllers\ConduitUserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// ログイン・ログアウト
Route::post('users/login', [ConduitAuthController::class, 'login'])->name('login');
Route::middleware('auth:sanctum')
->post('/users/logout', [ConduitAuthController::class, 'logout'])->name('logout');

// ユーザー CRU-
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/users', [ConduitUserController::class, 'show']);
});

// 記事 CRUD
Route::group(['middleware' => ['auth:sanctum']], function () {
    //
});