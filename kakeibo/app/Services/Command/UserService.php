<?php 

namespace App\Services\Command;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserService
{
    public function register($register_user_params)
    {
        $register_user_params['password'] = Hash::make($register_user_params['password']);
        $register_user_params['api_token'] = Str::random(60);
        User::create($register_user_params);
    }
} 