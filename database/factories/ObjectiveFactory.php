<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Objective;
use Faker\Generator as Faker;

$factory->define(Objective::class, function (Faker $faker) {

    return [
        'process_id' => $faker->word,
        'perspective_id' => $faker->word,
        'descripcion' => $faker->word,
        'level' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
