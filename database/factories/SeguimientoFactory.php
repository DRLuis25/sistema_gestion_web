<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Seguimiento;
use Faker\Generator as Faker;

$factory->define(Seguimiento::class, function (Faker $faker) {

    return [
        'process_id' => $faker->word,
        'activity' => $faker->word,
        'rol_id' => $faker->randomDigitNotNull,
        'flow_id' => $faker->randomDigitNotNull,
        'time' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
