<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ScoutMasterDatabase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('scoutmasters', function (Blueprint $table) {

          $table->increments('id');
          $table->string('firstname')->unsigned()->nullable();
          $table->string('lastname')->unsigned()->nullable();

          $table->foreign('troop_id')->references('id')->on('troops');

      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
