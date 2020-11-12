<?php

namespace App\Services\Query;

use App\Models\User;

class UserService 
{
    public function getById($user_id)
    {
        return User::find($user_id);
    }
}