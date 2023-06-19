<?php

namespace Database\Seeders;

use App\Models\Api;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ApiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $apis =

        [
              [
              
                "name" => "SmsActivate",
              ],


              [
                
                "name" => "Autofication",
              ],

              [
                
                "name" => "Smspva",
              ],

              [
                
                "name" => "5sim",
              ],
              [
                
                "name" => "OnlineSim",
              ],
        ];

        foreach ($apis as $key => $value) {
            Api::create($value);
        }
    }
}
