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
$faker = \Faker\Factory::create('pt_BR');

$factory->define(ResultSystems\Emtudo\Models\User::class, function() use($faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => str_random(10),
        'remember_token' => str_random(10),
    ];
});

$factory->define(ResultSystems\Emtudo\Models\Testes::class, function() use($faker) {
    return [
        'email' => $faker->email,
        'token' => str_random(10),
        'created_at' => $faker->dateTime(),
        'updated_at' => $faker->dateTime(),
    ];
});
