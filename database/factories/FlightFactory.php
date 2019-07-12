<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Flight;
use Faker\Generator as Faker;

$factory->define(Flight::class, function (Faker $faker) {
    return [
        'departure_time' => $faker->dateTimeInInterval('now', '+ 15 minutes'),
        'arrival_time' => $faker->dateTimeInInterval('+ 15 hours', '+ 15 minutes'),
        'seats' => $faker->numberBetween(100, 250),
        'price' => $faker->randomFloat('2', 30, 250)
    ];
});
