<?php

use Illuminate\Database\Seeder;

class BlackPointsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $black_points = [
            [
                'latitude' => -12.046374,
                'longitude' => -77.042793,
                'city_id' => rand(1,25),
                'status_id' => 1,
                'user_id' => 1,
            ]
        ];

        DB::table('black_points')->insert($black_points);
    }
}
