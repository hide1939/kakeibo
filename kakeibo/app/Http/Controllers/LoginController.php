<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{
    public function index()
    {
        return view('layouts.login');
    }

    public function login(Request $request)
    {
        $remember = $request->remember_me;
        if (!Auth::attempt($request->only('name', 'email', 'password'), $remember)) {
            return redirect('login');
        };

        if ($remember) {
            $remember_cookie_name = Auth::getRecallerName();
            Cookie::queue(
                $name = $remember_cookie_name,
                $value = Cookie::queued($remember_cookie_name)->getValue(),
                $minutes = 10080, // 7日
                $path = '/',
                $domain = null, 
                $secure = null // 本番ではsecure属性はonにしたい
            );
        }

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