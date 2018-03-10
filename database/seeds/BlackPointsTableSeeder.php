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
        $faker = Faker\Factory::create();
        $points = [
            [
                'latitude' => -12.2720956,
                'longitude' => -76.27108329999999,
                'detail' => $faker->text(50), // secret
                'city_id' => rand(1,25),
                'status_id' => 1,
                'user_id' => 1,
            ],
            [
                'latitude' => -12.664268927398457,
                'longitude' => -76.5303125000413,
                'detail' => $faker->text(50), // secret
                'city_id' => rand(1,25),
                'status_id' => 1,
                'user_id' => 1,
            ],
            [
                'latitude' => -12.045810378658302,
                'longitude' => -77.01812911462571,
                'detail' => $faker->text(50), // secret
                'city_id' => rand(1,25),
                'status_id' => 1,
                'user_id' => 1,
            ],
            [
                'latitude' => -12.047367243691909,
                'longitude' => -77.01872992944504,
                'detail' => $faker->text(50), // secret
                'city_id' => rand(1,25),
                'status_id' => 1,
                'user_id' => 1,
            ],
            [
                'latitude' => -12.052991184903934,
                'longitude' => -77.01709914636399,
                'detail' => $faker->text(50), // secret
                'city_id' => rand(1,25),
                'status_id' => 1,
                'user_id' => 1,
            ],
            [
                'latitude' => -12.057775639114874,
                'longitude' => -77.01066184472825,
                'detail' => $faker->text(50), // secret
                'city_id' => rand(1,25),
                'status_id' => 1,
                'user_id' => 1,
            ],
            [
                'latitude' => -12.069540958685426,
                'longitude' => -77.01212096643235,
                'detail' => $faker->text(50), // secret
                'city_id' => rand(1,25),
                'status_id' => 1,
                'user_id' => 1,
            ],
            [
                'latitude' => -12.079372933671683,
                'longitude' => -77.00957632740875,
                'detail' => $faker->text(50), // secret
                'city_id' => rand(1,25),
                'status_id' => 1,
                'user_id' => 1,
            ],
            [
                'latitude' => -12.083219520916797,
                'longitude' => -77.00963838087921,
                'detail' => $faker->text(50), // secret
                'city_id' => rand(1,25),
                'status_id' => 1,
                'user_id' => 1,
            ],
            [
                'latitude' => -12.150354343482052,
                'longitude' => -76.96843965041046,
                'detail' => $faker->text(50), // secret
                'city_id' => rand(1,25),
                'status_id' => 1,
                'user_id' => 1,
            ],
            [
                'latitude' => -12.14934744600937,
                'longitude' => -76.94200379835968,
                'detail' => $faker->text(50), // secret
                'city_id' => rand(1,25),
                'status_id' => 1,
                'user_id' => 1,
            ],
            [
                'latitude' => -12.001789259750549,
                'longitude' => -76.99934291579831,
                'detail' => $faker->text(50), // secret
                'city_id' => rand(1,25),
                'status_id' => 1,
                'user_id' => 1,
            ],

        ];

        DB::table('black_points')->insert($points);

    }
}
