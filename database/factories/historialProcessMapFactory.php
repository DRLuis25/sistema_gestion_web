<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\historialProcessMap;
use Faker\Generator as Faker;

$factory->define(historialProcessMap::class, function (Faker $faker) {

    return [
        'process_map_id' => $faker->word,
        'description' => $faker->word,
        'data' => $faker->text,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
