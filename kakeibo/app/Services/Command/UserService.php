<?php 

namespace App\Services\Command;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function regist($regist_user_params)
    {
        $regist_user_params['password'] = Hash::make($regist_user_params['password']);
        User::create($regist_user_params);
    }
} 