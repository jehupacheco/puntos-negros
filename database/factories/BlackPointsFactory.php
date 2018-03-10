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
        'latitude' => -12.046374,
        'longitude' => -77.042793,
        'details' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'city_id' => rand(1,25),
        'status_id' => 1,
        'user_id' => 1,
    ];
});
