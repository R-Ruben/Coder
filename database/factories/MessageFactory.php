<?php

use Faker\Generator as Faker;

$factory->define(App\Message::class, function (Faker $faker) {
    return [
        'user_id' => rand(1,30),
        'message' => $faker->sentence(),
        'receiving_user_id' => rand(1,30)
    ];
});
