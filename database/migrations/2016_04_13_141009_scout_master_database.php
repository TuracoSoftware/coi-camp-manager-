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
          $table->string('firstname')->nullable();
          $table->string('lastname')->nullable();
          $table->unsignedInteger('troop_id');
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
        Schema::drop('scoutmasters');
    }
}
