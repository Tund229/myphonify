<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Super Admin',
            'email' => 'super-admin@super-admin.com',
            'identifiant' => mt_rand(10000000, 99999999),
            'password' => Hash::make('123456789'),
            'role' => 'super-admin',
        ]);

        User::create([
            'name' => 'User',
            'email' => 'user@user.com',
            'identifiant' => mt_rand(10000000, 99999999),
            'password' => Hash::make('123456789'),
            'role' => 'user',
        ]);

        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'identifiant' => mt_rand(10000000, 99999999),
            'password' => Hash::make('123456789'),
            'role' => 'admin',
        ]);
    }
}
