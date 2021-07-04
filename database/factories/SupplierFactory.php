<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Supplier;
use Faker\Generator as Faker;

$factory->define(Supplier::class, function (Faker $faker) {

    return [
        'ruc' => $faker->numberBetween(11111111111, 99999999999),
        'name' => $faker->name(),
        'contact_name' => $faker->name(),
        'contact' => $faker->tollFreePhoneNumber(),
        'email' => $faker->safeEmail(),
        'address' => $faker->streetAddress(),
        'company_id' => '1',
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
