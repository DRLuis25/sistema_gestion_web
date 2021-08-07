<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\processType;
use Faker\Generator as Faker;

$factory->define(processType::class, function (Faker $faker) {

    return [
        'process_id' => $faker->word,
        'type' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
