<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Audit;
use Faker\Generator as Faker;

$factory->define(Audit::class, function (Faker $faker) {

    return [
        'description' => $faker->text,
        'subject_id' => $faker->word,
        'subject_type' => $faker->word,
        'user_id' => $faker->word,
        'properties' => $faker->text,
        'host' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
