<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\perspectiveCompany;
use Faker\Generator as Faker;

$factory->define(perspectiveCompany::class, function (Faker $faker) {

    return [
        'company_id' => $faker->word,
        'descripcion' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
