<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Middleware\AdminMiddleware;

class AdminController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isAdmin');
    }
    function dashboard()
    {
        $title = 'Dashboard Admin';
        $userLogin = Session::get('user');
        $user = User::with('role')->where('role_id', $userLogin)->first();
        return view('admin.dashboard', compact('user', 'title'));
    }
}
