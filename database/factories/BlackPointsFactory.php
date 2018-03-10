<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Models\BlackPoint::class, function (Faker $faker) {
    return [
        'latitude' => $faker->latitude(-12.046374, -8.086394),
        'longitude' => $faker->longitude(-76.042793,-75.142893),
        'detail' => $faker->text(50), // secret
        'city_id' => rand(1,25),
        'status_id' => 1,
        'user_id' => 1,
    ];
});
