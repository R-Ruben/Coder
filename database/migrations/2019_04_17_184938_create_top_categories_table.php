<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('top_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });

        DB::table('top_categories')->insert(array (
            ['name' => 'Questions'],
            ['name' => 'Projects'],
            ['name' => 'Miscellaneous']
            ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('top_categories');
    }
}
