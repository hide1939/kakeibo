<?php

namespace App\UseCases;

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileImageUseCase
{
    public function store(UploadedFile $profile_image, $user_id)
    {
        // DB
        $user = User::find($user_id);
        $profile_image_path = Hash::make($user->id) . '.' . $profile_image->extension();
        $user->profile_image_path = $profile_image_path;
        $user->save();

        // Storage
        Storage::putFileAs('profile_image', $profile_image, $profile_image_path);
    }
}