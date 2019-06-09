<?php

use Faker\Generator as Faker;

$factory->define(App\Application::class, function (Faker $faker) {
    if(rand(0,1) == 1)
    $accepted = null;
    else
    $accepted = rand(0,1);
    return [
        'motivation' => $faker->paragraphs(rand(1,3), true),
        'price' => rand(10,2500),
        'user_id' => rand(1,30),
        'project_id' => rand(1,30),
        'accepted' => $accepted
    ];
});
