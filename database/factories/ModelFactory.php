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
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = ('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\TodoList::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->domainName,
        'description' => $faker->sentence(),
        'user_id' => 1,
    ];
});

$factory->define(App\Item::class, function (Faker\Generator $faker) {

    return [
        'description' => $faker->sentence(),
        'completed' => $faker->randomNumber([0,1]),
        'starred' => $faker->randomNumber([0,1]),
        'todo_list_id' => $faker->randomDigitNotNull,
    ];
});