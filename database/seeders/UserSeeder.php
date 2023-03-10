<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'username' => "Broodje kebab",
                'handle' => 'jarbottle',
                'email' => 'appelsapmoedereter@gmail.com',
                'password' => Hash::make('OmaEet33'),
                'profile_picture' => '1_profile.jpg',
                'profile_header' => '1_banner.jpg'
            ],
            [
                'username' => "Stopcontact likker",
                'handle' => 'itzdevs',
                'email' => 'eetkinderenvoorontbijt@outlook.com',
                'password' => Hash::make('testen'),
            ],
            [
                'username' => 'kebabcontact likker',
                'handle' => 'broodjekebablover',
                'email' => 'mamaikbenbangkommeophalen@help.com',
                'password' => Hash::make('TestWachtwoordVoorTyler')
            ]

        ];

        foreach($data as $item) {
            DB::table('users')->insert($item);
        }
    }
}
