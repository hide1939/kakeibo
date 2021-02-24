<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegularPostRequest extends FormRequest
{
    public function rules()
    {
        return [
            'item' => 'required|string',
            'amount' => 'required|integer',
        ];
    }
}
