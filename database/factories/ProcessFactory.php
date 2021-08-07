<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Process;
use Faker\Generator as Faker;

$factory->define(Process::class, function (Faker $faker) {

    return [
        'process_map_id' => $faker->word,
        'name' => $faker->word,
        'description' => $faker->word,
        'parent_process_id' => $faker->randomDigitNotNull,
        'status' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
