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
        $table->integer('id')->increments();
        $table->integer('scout_id')->unsigned();
        $table->integer('meritbadge_id')->unsigned();

        $table->foreign('meritbadge_id')->references('id')->on('scouts');
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
