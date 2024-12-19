<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Configuration;
use Faker\Generator as Faker;

$factory->define(Configuration::class, function (Faker $faker) {

    return [
        'site_name' => $faker->word,
        'facebook' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
