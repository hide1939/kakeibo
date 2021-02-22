<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginPostRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|exists:users',
            'email' => 'required|exists:users',
            'password' => 'required|exists:users',
        ];
    }
}
