<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\processCriterio;
use Faker\Generator as Faker;

$factory->define(processCriterio::class, function (Faker $faker) {

    return [
        'process_id' => $faker->word,
        'criterio_id' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
