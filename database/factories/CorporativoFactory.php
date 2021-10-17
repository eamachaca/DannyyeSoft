<?php

use App\Models\Corporativo;
use App\Models\Usuario;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Str;

/** @var Factory $factory */

$factory->define(Corporativo::class, function (Faker $faker) {
    $name = $faker->firstName;
    return [
        'S_NombreCorto' => $name,
        'S_NombreCompleto' => "$name $faker->lastName",
        'S_DBName' => $faker->word,
        'S_DBUsuario' => $faker->userName,
        'S_DBPassword' => Str::random(8),
        'S_SystemUrl' => Str::random(15),
        'S_Activo' => $faker->numberBetween(0, 2),
        'D_FechaIncorporacion' => $faker->dateTime(),
        'tw_usuarios_id' => Usuario::inRandomOrder()->first()->id,

    ];
});
