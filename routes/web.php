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
// Route::get('/guest', function () {
//     return view('conduit_home_guest');
// });

// 認証済みhome(認証未設定)
// Route::prefix('conduit')
// ->name('conduit.')
// ->controller(ConduitArticleController::class)
// ->group(function () {
//     Route::get('/', 'index')->name('index'); // ホーム
//     Route::get('/editor', 'editorNew')->name('editorNew'); // 新規作成
//     Route::post('/', 'store')->name('store'); // 投稿
//     Route::get('/editor/article{id}', 'editorExisting')->name('editorExisting'); // 編集
//     Route::post('/editor/article{id}', 'update')->name('update'); // 更新
//     Route::get('/article/article{id}', 'article')->name('article'); // 閲覧
//     Route::post('/article/article{id}/destroy', 'destroy')->name('destroy'); // 削除
// });



// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__ . '/auth.php';