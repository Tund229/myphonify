<?php

namespace Database\Seeders;

use Faker\Generator as Faker;
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
    public function run(Faker $faker)
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
            'is_admin' => true,
        ]);

        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'identifiant' => mt_rand(10000000, 99999999),
            'password' => Hash::make('123456789'),
            'role' => 'admin',
            'is_admin' => true,

        ]);

        
        for ($i = 0; $i < 100; $i++) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'identifiant' => mt_rand(10000000, 99999999),
                'password' => Hash::make("password"),
            ]);
        }
    }
}
