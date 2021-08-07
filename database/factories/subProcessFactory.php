<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\subProcess;
use Faker\Generator as Faker;

$factory->define(subProcess::class, function (Faker $faker) {

    return [
        'process_map_id' => $faker->word,
        'name' => $faker->word,
        'description' => $faker->word,
        'parent_process_id' => $faker->word,
        'status' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
