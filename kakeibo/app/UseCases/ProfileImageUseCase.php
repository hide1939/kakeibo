<?php

namespace App\UseCases;

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProfileImageUseCase
{
    public function store(UploadedFile $profile_image, $user_id)
    {
        // DB
        $user = User::find($user_id);
        $profile_image_path = Str::random(20) . '.' . $profile_image->extension();
        $user->profile_image_path = $profile_image_path;
        $user->save();

        // storage
        // TODO:新しい画像をストレージに保存するときに前の画像はストレージから消したいよね -> s3に無駄な画像が増えていく
        // here
        Storage::putFileAs('profile_image', $profile_image, $profile_image_path);
    }

    public function delete($user_id)
    {
        // DB
        $user = User::find($user_id);
        $profile_image_path = $user->profile_image_path;
        $user->profile_image_path = null;
        $user->save();

        // storage
        Storage::delete('profile_image/' . $profile_image_path);
    }
}