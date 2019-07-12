<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\User;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName, 
        'lastname' => $faker->lastName, 
        'birth_day' => $faker->dateTimeThisCentury()->format('Y-m-d'), 
        'sex' => $faker->boolean(50)?'man':'woman', 
        'email' => $faker->unique()->safeEmail, 
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', //password
        'country' => $faker->country,
    ];
});
