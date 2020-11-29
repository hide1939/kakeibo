<?php

namespace App\Http\Controllers;

use App\Services\Command\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegistController extends Controller
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

    public function store(Request $request)
    {
        $this->service->regist($request->all());

        // name,emailのどちらか＋passwordで認証できる
        if (!Auth::attempt($request->only('name', 'email', 'password'))) {
            return redirect('/regist');
        }

        return redirect('/regular');
    }
}