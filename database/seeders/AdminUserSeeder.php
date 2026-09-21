<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@gvc.com'],
            [
                'name'     => 'GVC Administrator',
                'password' => Hash::make('password'),
                'role'     => 'admin',
                'phone'    => '08000000000',
                'address'  => 'Global Value Chain HQ',
            ]
        );
    }
}