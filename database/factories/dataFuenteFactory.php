<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\dataFuente;
use Faker\Generator as Faker;

$factory->define(dataFuente::class, function (Faker $faker) {

    return [
        'indicator_id' => $faker->word,
        'fecha' => $faker->date('Y-m-d H:i:s'),
        'valor' => $faker->randomDigitNotNull,
        'estado' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
