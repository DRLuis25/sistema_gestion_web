<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Perspective;
use Faker\Generator as Faker;

$factory->define(Perspective::class, function (Faker $faker) {

    return [
        'process_id' => $faker->word,
        'descripcion' => $faker->word
    ];
});
