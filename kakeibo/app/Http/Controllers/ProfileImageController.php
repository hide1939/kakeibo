<?php

namespace App\Http\Controllers;

use App\UseCases\ProfileImageUseCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileImageController extends Controller
{
    public function edit()
    {
        return view('layouts.profileimage');
    }

    public function store(Request $request, ProfileImageUseCase $usecase)
    {
        $usecase->store($request->file('profile_image'), Auth::id());

        return response(200);
    }
}