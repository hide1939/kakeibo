<?php

namespace App\Http\Controllers;

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
        return view('layouts.profileimage');
    }

    public function store(Request $request)
    {
        $this->usecase->store($request->file('profile_image'), Auth::id());

        return response(200);
    }

    public function destroy() 
    {
        $this->usecase->delete(Auth::id());

        return response(200);
    }
}