<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'userName' => 'Dewa',
            'email' => 'user1@email.com',
            'password' => Hash::make('user123'),
        ]);

        // User::create([
        //     'userName' => 'Nama',
        //     'email' => 'user2@email.com',
        //     'password' => Hash::make('user123'),
        // ]);
    }
}
