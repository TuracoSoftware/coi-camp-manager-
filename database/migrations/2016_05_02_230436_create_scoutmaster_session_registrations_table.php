<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScoutmasterSessionRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('scoutmaster_session_registration', function (Blueprint $table) {
          //
          // $table->engine = 'InnoDB';
          $table->increments('id');
          $table->integer('scoutmaster_id')->unsigned()->nullable();
          $table->integer('scoutmaster_session')->unsigned()->nullable();

          $table->foreign('scoutmaster_id')->references('id')->on('scoutmasters');
          $table->foreign('scoutmaster_session')->references('id')->on('scoutmaster_sessions');


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
