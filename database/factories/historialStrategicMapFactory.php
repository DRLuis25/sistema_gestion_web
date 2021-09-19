<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\historialStrategicMap;
use Faker\Generator as Faker;

$factory->define(historialStrategicMap::class, function (Faker $faker) {

    return [
        'matriz_priorizado_id' => $faker->word,
        'process_id' => $faker->word,
        'description' => $faker->word,
        'data' => $faker->text,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
