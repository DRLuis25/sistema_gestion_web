<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\processFlowDiagram;
use Faker\Generator as Faker;

$factory->define(processFlowDiagram::class, function (Faker $faker) {

    return [
        'process_map_id' => $faker->word,
        'process_id' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'data' => $faker->text
    ];
});
