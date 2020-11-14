<?php

namespace App\UseCases;

use App\Models\User;
use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProfileImageUseCase
{
    public function store(UploadedFile $profile_image, $user_id)
    {
        DB::beginTransaction();
        try {
            // DB
            $user = User::find($user_id);
            $previous_profile_image_path = $user->profile_image_path;
            $profile_image_path = Str::random(20) . '.' . $profile_image->extension();
            $user->profile_image_path = $profile_image_path;
            $user->save();

            // storage
            // 以前の画像をストレージから削除
            Storage::delete('profile_image/' . $previous_profile_image_path);
            // 新規画像をストレージに登録
            Storage::putFileAs('profile_image', $profile_image, $profile_image_path);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('プロフィール画像登録処理中に例外が発生。DBをロールバックしました');
            throw $e->getMessage();
        }
        DB::commit();
    }

    public function delete($user_id)
    {
        DB::beginTransaction();
        try {
            // DB
            $user = User::find($user_id);
            $profile_image_path = $user->profile_image_path;
            $user->profile_image_path = null;
            $user->save();

            // storage
            Storage::delete('profile_image/' . $profile_image_path);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('プロフィール画像削除処理中に例外が発生。DBをロールバックしました');
            throw $e->getMessage();
        }
        DB::commit();
    }
}