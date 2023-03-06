<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class CommentSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'user_id' => 1,
                'post_id' => 1,
                'comment' => "Amazing picture",
            ],
            [
                'user_id' => 2,
                'post_id' => 1,
                'comment' => "Great post",
            ]
        ];

        foreach($data as $item) {
            DB::table('comments')->insert($item);
        }
    }
}
