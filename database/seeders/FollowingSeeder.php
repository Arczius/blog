<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class FollowingSeeder extends Seeder
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
                "user_id" => 1,
                "follow_id" => 2,
            ],
        ];

        foreach($data as $item) {
            DB::table('following')->insert($item);
        }
    }
}
