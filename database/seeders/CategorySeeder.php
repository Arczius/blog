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
                'name' => "Food",
                'picture' => '',
            ],
            [
                'name' => "Tech",
                'picture' => '',
            ]
        ];

        foreach($data as $item) {
            DB::table('categories')->insert($item);
        }
    }
}
