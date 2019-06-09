<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(),
        'body' => $faker->paragraphs(rand(1,10), true),
        'user_id' => rand(1,30),
        'top_category_id' => rand(1,3),
        'rep' => rand(-5,10)
    ];
});
