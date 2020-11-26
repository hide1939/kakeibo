<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileImageController;
use App\Http\Controllers\RegistController;
use App\Http\Controllers\RegularController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// ホーム画面
Route::get('/', function () {
    return view('welcome');
});

// 新規登録関連
Route::get('/regist', [RegistController::class, 'create']);
Route::post('/regist', [RegistController::class, 'store']);

// ログイン関連
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout']);

Route::group(['middleware' => ['auth']], function () {
    // プロフィール画像アップロード関連
    Route::get('/profile_image', [ProfileImageController::class, 'edit']);
    Route::post('/profile_image', [ProfileImageController::class, 'store']);
    Route::delete('/profile_image', [ProfileImageController::class, 'destroy']);

    // 定期収支登録関連
    Route::get('/regular', [RegularController::class, 'edit']);
    Route::post('/regular', [RegularController::class, 'store']);
});