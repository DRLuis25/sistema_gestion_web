<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\supplyChain;
use Faker\Generator as Faker;

$factory->define(supplyChain::class, function (Faker $faker) {

    return [
        'business_unit_id' => $faker->word,
        'period' => $faker->word,
        'launch' => $faker->date('Y-m-d H:i:s'),
        'status' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
