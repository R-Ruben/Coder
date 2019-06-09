<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // factory('App\User', 40)->create();
        // factory('App\Post', 200)->create();
        // factory('App\Application', 50)->create();
        // factory('App\Comment', 400)->create();
        // factory('App\Message', 1000)->create();
        // factory('App\Project', 30)->create();
        factory('App\Friend', 200)->create();

    }
}
