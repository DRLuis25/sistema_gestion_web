<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\objectiveCompany;
use Faker\Generator as Faker;

$factory->define(objectiveCompany::class, function (Faker $faker) {

    return [
        'company_id' => $faker->word,
        'descripcion' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
