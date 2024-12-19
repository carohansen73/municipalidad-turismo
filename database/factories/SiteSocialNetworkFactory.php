<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\SiteSocialNetwork;
use Faker\Generator as Faker;

$factory->define(SiteSocialNetwork::class, function (Faker $faker) {

    return [
        'url' => $faker->word,
        'social_network_id' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
