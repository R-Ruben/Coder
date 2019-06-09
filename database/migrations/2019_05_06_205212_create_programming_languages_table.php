<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgrammingLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programming_languages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('cName');
        });

DB::table('programming_languages')->insert(array (
            ['name' => 'CSS', 'cName' => 'css'],
            ['name' => 'JavaScript', 'cName' => 'js'],
            ['name' => 'HTML', 'cName' => 'html'],
            ['name' => 'PHP', 'cName' => 'php'],
            ['name' => 'Ruby', 'cName' => 'ruby'],
            ['name' => 'Python', 'cName' => 'python'],
            ['name' => 'Java', 'cName' => 'java'],
            ['name' => 'C', 'cName' => 'c'],
            ['name' => 'C#', 'cName' => 'csharp'],
            ['name' => 'C++', 'cName' => 'cpp'],
            ['name' => 'Other', 'cName' => 'other'],
            ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('programming_languages');
    }
}
