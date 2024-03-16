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
     */
    public function run(): void
    {
        User::insert(
            [
                [
                    'name' => 'Mohamed Ashraf',
                    'role' => 'superadmin',
                    'email' => 'mohamedashraf@gmail.com',
                    'password' => Hash::make('mohamed123')
                ],
                [
                    'name' => 'Mohamed Sultan',
                    'role' => 'admin',
                    'email' => 'sultan@gmail.com',
                    'password' => Hash::make('sultan123')
                ],
                [
                    'name' => 'Omar Mohamed',
                    'role' => 'normal',
                    'email' => 'omar@gmail.com',
                    'password' => Hash::make('omar123')
                ],
            ]
        );
    }
}
