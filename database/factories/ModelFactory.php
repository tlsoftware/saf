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

/*

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('123123'),
        'remember_token' => str_random(10),
    ];
});

*/


$factory->define(App\Customer::class, function (Faker\Generator $faker) {

    return [
        'rut' => $faker->randomNumber($nbDigits = 9),
        'bs_name' => $faker->bs,
        'name' => $faker->company,
        'contact_name' => $faker->name,
        'position' => $faker->jobTitle,
        'phone1' => "+569". $faker->randomNumber($nbDigits = 8),
        'email1' => $faker->email,
        'web' => $faker->safeEmailDomain,
        'next_mng' => null,
        'next_mng' => $faker->dateTimeBetween('- 7 days', 'now'),
        'user_id' => $faker->numberBetween($min = 1, $max = 2),
        'bstype_id' => $faker->numberBetween($min = 1, $max = 2)
    ];
});
