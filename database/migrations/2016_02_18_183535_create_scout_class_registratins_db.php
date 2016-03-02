<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScoutClassRegistratinsDb extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::create('scout_registrations', function(Blueprint $table) {
          $table->increments('id');
          $table->string('block1');
          $table->string('block2');
          $table->string('block3');
          $table->string('block4');
          $table->string('block5');
          $table->string('block6');
          $table->unsignedInteger('scout_id')->nullable();
          $table->foreign('scout_id')->references('id')->on('scouts');
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        //Schema::drop('scout_registrations');
    }
}
