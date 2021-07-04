<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\businessUnit;
use Faker\Generator as Faker;

$factory->define(businessUnit::class, function (Faker $faker) {

    return [
        'company_id' => $faker->word,
        'name' => $faker->word,
        'description' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
