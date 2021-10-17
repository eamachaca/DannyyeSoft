<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Usuario;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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

$factory->define(Usuario::class, function (Faker $faker) {
    return [
        'S_Nombre' => $faker->firstName,
        'S_Apellidos' => $faker->firstName,
        'username' => $faker->userName,
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt('12345'),
        'S_Activo'=>$faker->numberBetween(0,2),
        'email_verified_at' => now(),
        'remember_token' => Str::random(10),
        'verification_token' => Str::random(10),
        'verified' => Str::random(10),
    ];
});
