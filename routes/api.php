<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ArticleController;

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
Route::prefix('/users')
->controller(AuthController::class)->group(function () {
    Route::post('/login', 'login');
    Route::post('/logout', 'logout');
    Route::post('/refresh', 'refresh');
});

// ユーザー CRU-
Route::prefix('/users')
->controller(UserController::class)->group(function () {
    Route::post('/', 'register');
    Route::get('/', 'show');
    Route::put('/', 'update');
});

// 記事 CRUD
Route::prefix('/articles')
->controller(ArticleController::class)->group(function () {
    Route::get('/feed', 'index');
    Route::post('/', 'create');
    Route::get('/{slug}', 'show');
    Route::put('/{slug}', 'update');
    Route::post('/{slug}', 'destroy');
});