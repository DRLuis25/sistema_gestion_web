<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {

    return [
        'company_id' => null,
        'dni' => $faker->randomNumber(8, true),
        'names' => $faker->name(),
        'lastNamePat' => $faker->lastName(),
        'lastNameMat' => $faker->lastName(),
        'phone' => $faker->tollFreePhoneNumber(),
        'address' => $faker->streetAddress(),
        'email' => $faker->safeEmail(),
        'email_verified_at' => null,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        'is_admin' => false,
        'isAdmin' => false,
        'remember_token' => null,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => null
    ];
});
