<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\UseCases\ProfileImageUseCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileImageController extends Controller
{
    private $usecase;

    public function __construct(ProfileImageUseCase $usecase)
    {
        $this->usecase = $usecase;
    }

    public function edit()
    {
        return view('layouts.profileimage', [
            // TODO:ここも認証つけたら直す
            'profile_image_path' => User::find(1)->profile_image_path
            // 'profile_image_path' => User::find(Auth::id())->profile_image_path
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