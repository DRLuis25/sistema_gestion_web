<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\matrizPriorizado;
use Faker\Generator as Faker;

$factory->define(matrizPriorizado::class, function (Faker $faker) {

    return [
        'process_map_id' => $faker->word,
        'process_criterio_id' => $faker->word,
        'description' => $faker->word,
        'process_id_data' => $faker->text,
        'process_values_data' => $faker->text,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
