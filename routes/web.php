<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConduitArticleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// 未認証home
Route::get('/guest', function () {
    return view('conduit_home_guest');
});

// 認証済みhome(認証未設定)
Route::prefix('conduit')
->name('conduit.')
->controller(ConduitArticleController::class)
->group(function () {
    Route::get('/', 'home')->name('home');
    Route::post('/', 'store')->name('store');
    Route::get('/article/article{id}', 'article')->name('article'); // 引数あり
    Route::get('/editor', 'editor')->name('editor'); // 引数なし
    Route::get('/editor/article{id}', 'editor')->name('editor'); // 引数あり
    Route::post('/', 'update')->name('update');
    Route::get('/article/article{id}', 'destroy')->name('destroy');
});

// 記事ページ
Route::get('/article', function () {
    return view('conduit_article');
});

// 記事作成・編集ページ
Route::get('/editor', function () {
    return view('conduit_editor');
});




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';