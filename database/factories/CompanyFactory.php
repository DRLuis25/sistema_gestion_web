<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Company;
use Faker\Generator as Faker;

$factory->define(Company::class, function (Faker $faker) {

    return [
        'ruc' => $faker->numberBetween(11111111111, 99999999999),
        'name' => $faker->company,
        'description' => $faker->word,
        'phone' => $faker->tollFreePhoneNumber(),
        'address' => $faker->streetAddress(),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => null
    ];
});
