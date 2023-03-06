<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'post_id' => 1,
                'name' => "Food",
                'picture' => '',
            ],
            [
                'post_id' => 1,
                'name' => "Tech",
                'picture' => '',
            ]
        ];

        foreach($data as $item) {
            DB::table('categories')->insert($item);
        }
    }
}
