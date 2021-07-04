<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\supplyChainCustomer;
use Faker\Generator as Faker;

$factory->define(supplyChainCustomer::class, function (Faker $faker) {

    return [
        'supply_chain_id' => $faker->word,
        'customer_id' => $faker->word,
        'parent_customer_id' => $faker->word,
        'level_id' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
