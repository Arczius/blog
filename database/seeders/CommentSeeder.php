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
                'comment' => "Amazing picture",
            ],
            [
                'comment' => "Great post",
            ]
        ];

        foreach($data as $item) {
            DB::table('comments')->insert($item);
        }
    }
}
