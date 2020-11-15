<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileImageController;
use App\Http\Controllers\RegistController;

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

Route::get('/', function () {
    return view('welcome');
});

// 新規登録関連
Route::get('/regist', [RegistController::class, 'create']);
Route::post('/regist', [RegistController::class, 'store']);

// プロフィール画像アップロード関連
Route::get('/profile_image', [ProfileImageController::class, 'edit']);
Route::post('/profile_image', [ProfileImageController::class, 'store']);
Route::delete('/profile_image', [ProfileImageController::class, 'destroy']);