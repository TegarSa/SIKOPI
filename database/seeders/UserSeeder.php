<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = [
            [
                'name' => 'admin',
                'email' => 'admin@virend.co.id',
                'institution' => 'virend',
                'role' => 'admin',
                'password' => Hash::make('virend12345')
            ],

            [
                'name' => 'staff',
                'email' => 'staff@virend.co.id',
                'institution' => 'virend',
                'role' => 'staff',
                'password' => Hash::make('virend12345')
            ],
            [
                'name' => 'manager',
                'email' => 'manager@virend.co.id',
                'institution' => 'virend',
                'role' => 'manager',
                'password' => Hash::make('virend12345')
            ],
            // [
            //     'name' => 'user',
            //     'email' => 'user@blud.co.id',
            //     'phone' => '08170039080',
            //     'institution' => 'syncore',
            //     'level' => 'subscriber',
            //     'password' => Hash::make('syncore12345')
            // ],
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
