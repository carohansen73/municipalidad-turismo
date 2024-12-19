<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {

    return [
        'title' => $faker->word,
        'summary' => $faker->word,
        'publication_date' => $faker->word,
        'slug' => $faker->word,
        'content' => $faker->text,
        'user_id' => $faker->randomDigitNotNull,
        'post_category_id' => $faker->randomDigitNotNull,
        'important_image' => $faker->word,
        'publish' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
