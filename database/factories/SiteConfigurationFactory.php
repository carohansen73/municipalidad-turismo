<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\SiteConfiguration;
use Faker\Generator as Faker;

$factory->define(SiteConfiguration::class, function (Faker $faker) {

    return [
        'title_place' => $faker->word,
        'subtitle_place' => $faker->word,
        'title_news' => $faker->word,
        'subtitle_news' => $faker->word,
        'title_events' => $faker->word,
        'subtitle_events' => $faker->word,
        'title_team' => $faker->word,
        'subtitle_team' => $faker->word,
        'description_team' => $faker->text,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
