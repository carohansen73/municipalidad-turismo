<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\SocialNetwork;
use Faker\Generator as Faker;

$factory->define(SocialNetwork::class, function (Faker $faker) {

    return [
        'name' => $faker->word,
        'icon' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
