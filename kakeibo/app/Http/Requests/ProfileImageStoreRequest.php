<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileImageStoreRequest extends FormRequest
{
    public function rules()
    {
        return [
            'profile_image' => 'required|file',
        ];
    }
}
