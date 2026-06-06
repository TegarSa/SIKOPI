<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [

            [
                'name' => 'Admin',
                'email' => 'admin@sikopi.com',
                'role' => 'admin',
                'password' => Hash::make('password'),
                'status' => 'aktif',
            ],

            [
                'name' => 'Sekretaris',
                'email' => 'sekretaris@sikopi.com',
                'role' => 'sekretaris',
                'password' => Hash::make('password'),
                'status' => 'aktif',
            ],

            [
                'name' => 'Bendahara',
                'email' => 'bendahara@sikopi.com',
                'role' => 'bendahara',
                'password' => Hash::make('password'),
                'status' => 'aktif',
            ],

            [
                'name' => 'Ketua',
                'email' => 'ketua@sikopi.com',
                'role' => 'ketua',
                'password' => Hash::make('password'),
                'status' => 'aktif',
            ],

        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}