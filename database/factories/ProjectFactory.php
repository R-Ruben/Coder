<?php

use Faker\Generator as Faker;

$factory->define(App\Project::class, function (Faker $faker) {

    if(rand(0,1) == 0) {
        $price_type = 'open';
    } else {
        $price_type = 'fixed';
    }

    return [
        'title' => $faker->sentence(),
        'description' => $faker->paragraphs(rand(1,8), true),
        'price' => rand(10,2500),
        'user_id' => rand(1,30),
        'deadline' => date('d-m-y'),
        'price_type' => $price_type
    ];
});
