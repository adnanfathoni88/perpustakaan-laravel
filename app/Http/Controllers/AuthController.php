<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    function index()
    {
        return view('auth/login');
    }
    function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::check()) {
                $role_id = Auth::user()->id;
                if ($role_id === 1) {
                    $request->session()->put('user', Auth::user()->id);
                    return redirect()->route('admin.dashboard');
                } else {
                    $request->session()->put('user', Auth::user()->id);
                    return redirect()->route('user.dashboard');
                }
            }
        }
        dd('login gagal');
    }
    function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
