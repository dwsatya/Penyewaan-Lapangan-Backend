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

        User::create([
            'userName' => 'Dewa Satya',
            'email' => 'dewa@email.com',
            'password' => Hash::make('dewa123'),
        ]);
    }
}
