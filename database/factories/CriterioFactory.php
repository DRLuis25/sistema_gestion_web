<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Criterio;
use Faker\Generator as Faker;

$factory->define(Criterio::class, function (Faker $faker) {

    return [
        'process_map_id' => $faker->word,
        'name' => $faker->word,
        'peso' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
