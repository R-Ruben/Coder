<?php

use Faker\Generator as Faker;

$factory->define(App\Comment::class, function (Faker $faker) {
    return [
        'body' => $faker->paragraphs(rand(1,3), true),
        'user_id' => rand(1,30),
        'post_id' => rand(1,200),
        'rep' => rand(-5,10)
    ];
});

