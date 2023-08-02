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
            'name' => 'User',
            'email' => 'myphonify@tester.com',
            'identifiant' => mt_rand(10000000, 99999999),
            'password' => Hash::make('GlowUpMyFuckingLife2290@'),
            'is_admin' => false,
        ]);

        User::create([
            'name' => 'Admin',
            'email' => 'myphonify@private.com',
            'identifiant' => mt_rand(10000000, 99999999),
            'password' => Hash::make('GlowUpMyFuckingLife2290@'),
            'role' => 'admin',
            'is_admin' => true,
        ]);

        
        // for ($i = 0; $i < 100; $i++) {
        //     User::create([
        //         'name' => $faker->name,
        //         'email' => $faker->unique()->safeEmail,
        //         'identifiant' => mt_rand(10000000, 99999999),
        //         'password' => Hash::make("password"),
        //     ]);
        // }
    }
}
