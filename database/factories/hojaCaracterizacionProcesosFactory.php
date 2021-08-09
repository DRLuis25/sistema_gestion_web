<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\hojaCaracterizacionProcesos;
use Faker\Generator as Faker;

$factory->define(hojaCaracterizacionProcesos::class, function (Faker $faker) {

    return [
        'process_map_id' => $faker->word,
        'process_id' => $faker->word,
        'mision' => $faker->word,
        'empieza' => $faker->word,
        'incluye' => $faker->word,
        'termina' => $faker->word,
        'entradas_data' => $faker->text,
        'proveedores_data' => $faker->text,
        'salidas_data' => $faker->text,
        'clientes_data' => $faker->text,
        'inspecciones_data' => $faker->text,
        'registros_data' => $faker->text,
        'variables_control_data' => $faker->text,
        'indicadores_data' => $faker->text,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
