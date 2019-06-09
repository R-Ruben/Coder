<?php

use Faker\Generator as Faker;

$factory->define(App\Friend::class, function (Faker $faker) {
    $user_id = rand(1,40);

    do {   
        $receiving_user_id = rand(1,40);
    
    } while(in_array($receiving_user_id, array($user_id)));

    return [
        'user_id' => $user_id,
        'receiving_user_id' => $receiving_user_id,
        'accepted' => rand(0,1),
    ];
});
