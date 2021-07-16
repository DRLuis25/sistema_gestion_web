<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Customer;
use Faker\Generator as Faker;

$factory->define(Customer::class, function (Faker $faker) {

    return [
        'dni' => $faker->randomNumber(8, true),
        'name' => $faker->company,
        'last_name' => $faker->companySuffix,
        'contact' => $faker->tollFreePhoneNumber(),
        'email' => $faker->safeEmail(),
        'address' => $faker->streetAddress(),
        'company_id' => '1',
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
