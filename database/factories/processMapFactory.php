<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\processMap;
use Faker\Generator as Faker;

$factory->define(processMap::class, function (Faker $faker) {

    return [
        'company_id' => $faker->word,
        'business_unit_id' => $faker->word,
        'period' => $faker->word,
        'launch' => $faker->date('Y-m-d H:i:s'),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
