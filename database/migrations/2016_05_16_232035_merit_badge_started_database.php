<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MeritBadgeStartedDatabase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('merit_badge_started', function (Blueprint $table) {
        $table->increments('id');
        $table->string('name');
        $table->integer('scout_id')->unsigned();

        $table->foreign('scout_id')->references('id')->on('scouts');
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
