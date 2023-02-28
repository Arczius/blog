<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CategoriesPostsSeeder extends Seeder
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
                'category_id'   =>  1,
                'post_id'       =>  1,
            ],
            [
                'category_id'   =>  2,
                'post_id'       =>  2,
            ],
            [
                'category_id'   =>  2,
                'post_id'       =>  1,
            ]
        ];

        foreach($data as $item){
            DB::table('categories_posts')->insert($item);
        }
    }
}
