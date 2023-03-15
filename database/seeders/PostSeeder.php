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
                'user_id' => 1,
                'title' => "Amazing post",
                'description' => 'This is an amazing description',
                'coverFile' => '1_cover.jpg',
                'file' => '1_content.jpg',
            ],
            [
                'user_id' => 1,
                'title' => "Amazing post 2",
                'description' => 'This is another amazing description',
                'coverFile' => '',
                'file' => '',
            ],
            [
                'user_id' => 1,
                'title' => "Amazing post 3",
                'description' => 'This is an amazing description',
                'coverFile' => '',
                'file' => '',
            ],
            [
                'user_id' => 2,
                'title' => "Amazing post 4",
                'description' => 'This is another amazing description',
                'coverFile' => '',
                'file' => '',
            ],
            [
                'user_id' => 2,
                'title' => "Amazing post 5",
                'description' => 'This is another amazing description',
                'coverFile' => '',
                'file' => '',
            ]
        ];

        foreach($data as $item) {
            DB::table('posts')->insert($item);
        }
    }
}
