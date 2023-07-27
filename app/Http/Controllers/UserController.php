<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }
    function dashboard()
    {
        $title = 'Dashboard User';
        $userLogin = Session()->get('user');
        $user = User::where('id', $userLogin)->first();
        return view('user/dashboard', compact('user', 'title'));
    }
    function index()
    {
        $title = 'Register';
        $user = User::with('role')->get();
        return view('user/index', compact('title', 'user'));
    }
    function create()
    {
        $title = 'Tambah User';
        $role = Role::all();
        return view('user/add-user', compact('title', 'role'));
    }
    function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'role_id' => 'required'
        ]);

        $password = Hash::make($data['password']);
        $data['password'] = $password;

        User::create($data);
        return redirect('/register');
    }
    function edit($id)
    {
        $title = 'Edit User';
        $user = User::with('role')->findOrFail($id);
        $role = Role::all();
        return view('user/edit-user', compact('title', 'user', 'role'));
    }
    function update(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required',
            'email' => 'required',
            'password' => '',
            'role_id' => 'required'
        ]);

        $password = Hash::make($data['password']);
        $data['password'] = $password;

        User::where('id', $request->id)->update($data);
        return redirect('/register');
    }
    function destroy($id)
    {
        User::destroy($id);
        return redirect('/register');
    }
}
