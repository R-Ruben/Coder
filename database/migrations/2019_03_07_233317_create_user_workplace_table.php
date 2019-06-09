<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserWorkplaceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_workplace', function (Blueprint $table) {
            $table->integer('workplace_id')->unsigned()->nullable();
      $table->foreign('workplace_id')->references('id')
            ->on('workplaces')->onDelete('cascade');

      $table->integer('user_id')->unsigned()->nullable();
      $table->foreign('user_id')->references('id')
            ->on('users')->onDelete('cascade');
            $table->date('start_date');
            $table->date('end_date');
      $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_workplace');
    }
}
