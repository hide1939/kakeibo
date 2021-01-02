<?php 

namespace App\Services\Command;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserService
{
    public function regist($regist_user_params)
    {
        $regist_user_params['password'] = Hash::make($regist_user_params['password']);
        $regist_user_params['api_token'] = Str::random(60);
        User::create($regist_user_params);
    }
} 