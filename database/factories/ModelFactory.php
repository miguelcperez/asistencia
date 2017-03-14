<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Personal::class, function (Faker\Generator $faker) {
    return [
    	'code' => $faker->randomNumber($nbDigits = 4),
        'name' => $faker->name,
        'payperhour' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 100)
    ];
});

$factory->define(App\Schedule::class, function (Faker\Generator $faker) {
    return [
    	'day' => $faker->dayOfWeek,
        'init_hour' => $faker->time,
        'end_hour' => $faker->time,
    ];
});

$factory->define(App\Assist::class, function (Faker\Generator $faker) {
    return [
    	'type' => $faker->randomElement(['entry', 'exit']),
    ];
});

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});