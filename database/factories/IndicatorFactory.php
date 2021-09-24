<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Indicator;
use Faker\Generator as Faker;

$factory->define(Indicator::class, function (Faker $faker) {

    return [
        'matriz_priorizado_id' => $faker->word,
        'process_id' => $faker->word,
        'frecuency_id' => $faker->word,
        'descripcion' => $faker->word,
        'formula' => $faker->text,
        'linea_base' => $faker->text,
        'objetivo' => $faker->word,
        'responsable' => $faker->word,
        'meta' => $faker->word,
        'iniciativas' => $faker->text,
        'rojo' => $faker->randomDigitNotNull,
        'verde' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
