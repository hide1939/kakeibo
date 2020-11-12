<?php

namespace App\Http\Controllers;

use App\Services\Query\UserService;
use App\UseCases\ProfileImageUseCase;
use Illuminate\Http\Request;
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

    public function edit()
    {
        return view('layouts.profileimage', [
            // TODO:ここも認証つけたら直す+コントローラで直接Eloquentは触らない
            'profile_image_path' => $this->service->getById(1)->profile_image_path
            // 'profile_image_path' => $this->service->getById(Auth::id())->profile_image_path
        ]);
    }

    public function store(Request $request)
    {
        // TODO:一旦認証は先送り
        // $this->usecase->store($request->file('profile_image'), Auth::id());
        $this->usecase->store($request->file('profile_image'), 1);

        return redirect('profile_image');
    }

    public function destroy() 
    {
        // TODO:一旦認証は先送り
        // $this->usecase->delete(Auth::id());
        $this->usecase->delete(1);

        return response(200);
    }
}