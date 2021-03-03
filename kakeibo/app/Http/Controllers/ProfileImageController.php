<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileImageStoreRequest;
use App\Services\Query\UserService;
use App\UseCases\ProfileImageUseCase;
use Illuminate\Support\Facades\Auth;

class ProfileImageController extends Controller
{
    private $usecase;

    private $service;

    public function __construct(ProfileImageUseCase $usecase, UserService $service)
    {
        $this->usecase = $usecase;
        $this->service = $service;
    }

    /**
     * ログイン(認証)後にプロフィール画像を更新する
     * 新規登録時とは処理を分ける
     */
    public function edit()
    {
        return view('layouts.profileimage', [
            'profile_image_path' => $this->service->getById(Auth::id())->profile_image_path,
            // TODO:Controllerから渡さなくても普通にviewでAuth::userで取ればいい
            'login_user_name' => Auth::user()->name
        ]);
    }

    public function store(ProfileImageStoreRequest $request)
    {
        $this->usecase->store($request->file('profile_image'), Auth::id());

        return redirect('profile_image');
    }

    // TODO:将来的にはAjaxにする
    public function destroy() 
    {
        $this->usecase->delete(Auth::id());

        return response(200);
    }
}