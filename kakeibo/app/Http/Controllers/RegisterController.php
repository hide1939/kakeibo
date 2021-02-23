<?php

namespace App\Http\Controllers;

use App\Services\Command\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    private $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function create()
    {
        return view('layouts.regist');
    }

    /**
     * 新規登録時にもプロフィール画像を登録できるようにする
     */
    public function store(Request $request)
    {
        $this->service->regist($request->all());

        // name,emailのどちらか＋passwordで認証できる
        if (!Auth::attempt($request->only('name', 'email', 'password'))) {
            return redirect('/register');
        }

        return redirect('/regular');
    }
}