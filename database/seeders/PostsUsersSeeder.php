<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class PostsUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'post_id' => 1,
                'user_id' => 1,
            ],
            [
                'post_id' => 2,
                'user_id' => 2,
            ]
        ];

        foreach($data as $item){
            DB::table('posts_users')->insert($item);
        }
    }
}
