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
                $role_id = Auth::user()->role_id;
                if ($role_id === 1) {
                    return redirect()->route('admin.dashboard');
                } else {
                    return redirect()->route('/user/dashboard');
                }
            }

            // $user = Auth::user();
            // $request->session()->put('id', $user->id);
        }
        dd('login gagal');
    }
    function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
