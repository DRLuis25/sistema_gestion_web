<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Indicator;
use Faker\Generator as Faker;

$factory->define(Indicator::class, function (Faker $faker) {

    return [
        'process_id' => $faker->word,
        'frecuency_id' => $faker->word,
        'descripcion' => $faker->word,
        'objetivo' => $faker->word,
        'responsable' => $faker->word,
        'iniciativas' => $faker->text,
        'linea_base' => $faker->text,
        'meta' => $faker->word,
        'formula' => $faker->text,
        'verde' => $faker->randomDigitNotNull,
        'rojo' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
