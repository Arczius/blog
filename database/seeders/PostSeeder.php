<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'title' => "Amazing post",
                'description' => 'This is an amazing description',
                'picture' => '',
            ],
            [
                'title' => "Amazing post 2",
                'description' => 'This is another amazing description',
                'picture' => '',
            ]
        ];

        foreach($data as $item) {
            DB::table('posts')->insert($item);
        }
    }
}
