<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('layouts.login');
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('name', 'email', 'password'))) {
            return redirect('login');
        };

        return redirect('/main');
    }

    /**
     * LoginControllerだけどlogoutも混ぜとく
     */
    public function logout()
    {
        Auth::logout();

        return redirect('login');
    }
}