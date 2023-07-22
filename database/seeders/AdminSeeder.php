<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $admin = Role::create(['nama' => 'admin']);
        $user = Role::create(['nama' => 'user']);

        User::create([
            'nama' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('adminadmin'),
            'role_id' => $admin->id,
        ]);
    }
}
